<?php

namespace PcbDingtalk;

use PcbDingtalk\Concerns\InteractsWithCache;
use PcbDingtalk\Concerns\InteractsWithHttp;

class Client
{
    use InteractsWithCache, InteractsWithHttp;

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $appSecret;

    /**
     * @var \Psr\SimpleCache\CacheInterface
     */
    protected $cache;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $http;

    /**
     * @param array $config
     * @param \Psr\SimpleCache\CacheInterface $cache
     * @param \GuzzleHttp\ClientInterface $http
     */
    public function __construct($config, $cache, $http)
    {
        $this->appId = $config['app_id'];
        $this->appSecret = $config['app_secret'];

        $this->cache = $cache;

        $this->http = $http;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }
}
