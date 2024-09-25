<?php

namespace PcbDingtalk\Tests;

use PcbDingtalk\Application;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

class TestCase extends BaseTestCase
{
    const DINGTALK_APP_ID = 'dingqfrd0vqoc2uyhcfg';
    const DINGTALK_APP_SECRET = 'JWAJwV1_yzceF3A_-6Z6TXFNzLtsBj0m376WjMOaNNttlKmyu5EiZR1VQE6tKb5v';

    protected $config = [
        'app_id' => self::DINGTALK_APP_ID,
        'app_secret' => self::DINGTALK_APP_SECRET,
    ];

    protected function app()
    {
        $cache = new Psr16Cache(new FilesystemAdapter());

        return new Application($this->config, $cache);
    }
}
