<?php

namespace PcbDingtalk\Services;

class UserAccessToken
{
    /**
     * @var \PcbDingtalk\Client
     */
    protected $client;

    /**
     * @param \PcbDingtalk\Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param string $authCode
     * @return array
     * @see https://open.dingtalk.com/document/orgapp/obtain-user-token
     */
    public function getAccessToken($authCode)
    {
        return $this->client->httpPost('https://api.dingtalk.com/v1.0/oauth2/userAccessToken', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'clientId' => $this->client->getAppId(),
                'clientSecret' => $this->client->getAppSecret(),
                'code' => $authCode,
                'refreshToken' => '',
                'grantType' => 'authorization_code',
            ]
        ]);
    }
}
