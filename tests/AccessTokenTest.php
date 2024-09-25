<?php

namespace PcbDingtalk\Tests;

class AccessTokenTest extends TestCase
{
    public function testGetAccessToken()
    {
        $accessToken = $this->app()->makeAccessToken()->getAccessToken();

        $this->assertIsString($accessToken);
    }
}
