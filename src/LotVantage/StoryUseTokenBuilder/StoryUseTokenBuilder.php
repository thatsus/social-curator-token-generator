<?php

namespace LotVantage\StoryUseTokenBuilder;

class StoryUseTokenBuilder
{
    private $client_token;
    private $owner_id;
    private $options;

    public function __construct($client_token, $owner_id, array $options)
    {
        $this->client_token = $client_token;
        $this->owner_id = $owner_id;
        $this->options = $options;
    }

    public function buildTokenPlain()
    {
        $token_pieces = array_values(array_merge(
            $this->options['verticals'] ?: [],
            $this->options['categories'] ?: [],
            $this->options['content_providers'] ?: [],
            $this->options['keywords'] ?: [],
            $this->options['pool'] ? [$this->options['pool']] : []
        ));

        sort($token_pieces);

        $token_pieces = join(':', $token_pieces);

        return "{$this->client_token}:{$this->owner_id}:{$token_pieces}";
    }

    public function buildToken()
    {
        return md5($this->buildTokenPlain());
    }

}
