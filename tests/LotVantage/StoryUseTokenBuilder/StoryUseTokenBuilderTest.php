<?php

namespace LotVantage\StoryUseTokenBuilder;

use Tests\TestCase;
use Mockery;

class StoryUseTokenBuilderTest extends TestCase
{

    public function testCreate()
    {
        new StoryUseTokenBuilder('testtoken', 'owner-1', []);
    }

    public function testPlainNoOptions()
    {
        $builder = new StoryUseTokenBuilder('testtoken', 'owner-1', []);
        $token = $builder->buildTokenPlain();
        $this->assertEquals('testtoken:owner-1:', $token);
    }

    public function testPlainAllOptions()
    {
        $builder = new StoryUseTokenBuilder('testtoken', 'owner-1', [
            'verticals' => ['flower', 'clothes'],
            'categories' => ['bad', 'snake'],
            'content_providers' => ['heartband.com', 'turtlesband.com'],
            'keywords' => ['bat', 'mat', 'hat', 'panama'],
            'pool' => 'reseller-14',
        ]);
        $token = $builder->buildTokenPlain();
        $this->assertEquals('testtoken:owner-1:bad:bat:clothes:flower:hat:heartband.com:mat:panama:reseller-14:snake:turtlesband.com', $token);
    }

    public function testTokenNoOptions()
    {
        $builder = new StoryUseTokenBuilder('testtoken', 'owner-1', []);
        $token = $builder->buildToken();
        $this->assertEquals(md5('testtoken:owner-1:'), $token);
    }

    public function testTokenAllOptions()
    {
        $builder = new StoryUseTokenBuilder('testtoken', 'owner-1', [
            'verticals' => ['flower', 'clothes'],
            'categories' => ['bad', 'snake'],
            'content_providers' => ['heartband.com', 'turtlesband.com'],
            'keywords' => ['bat', 'mat', 'hat', 'panama'],
            'pool' => 'reseller-14',
        ]);
        $token = $builder->buildToken();
        $this->assertEquals(md5('testtoken:owner-1:bad:bat:clothes:flower:hat:heartband.com:mat:panama:reseller-14:snake:turtlesband.com'), $token);
    }
}
