<?php

namespace PcbDingtalk\Services;

use PcbDingtalk\Exceptions\RuntimeException;

class AccessToken
{
    /**
     * @var \PcbDingtalk\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $cachePrefix = 'access_token.';

    /**
     * @param \PcbDingtalk\Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     * @throws \PcbDingtalk\Exceptions\RuntimeException
     * @see https://open.dingtalk.com/document/orgapp/obtain-the-access_token-of-an-internal-app
     */
    public function getAccessToken()
    {
        $key = $this->client->buildCacheKey([
            'app_id' => $this->client->getAppId(),
        ], $this->cachePrefix);

        if ($this->client->hasInCache($key)) {
            return $this->client->getFromCache($key);
        }

        $body = $this->client->httpPost('https://api.dingtalk.com/v1.0/oauth2/accessToken', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'appKey' => $this->client->getAppId(),
                'appSecret' => $this->client->getAppSecret(),
            ]
        ]);

        if (!isset($body['accessToken'])) {
            throw new RuntimeException('DingTalk API response is missing accessToken');
        }

        if (!isset($body['expireIn'])) {
            throw new RuntimeException('DingTalk API response is missing expireIn');
        }

        $this->client->putInCache($key, $body['accessToken'], $body['expireIn'] - 100);

        return $body['accessToken'];
    }
}
