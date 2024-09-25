<?php

namespace PcbDingtalk\Services;

use PcbDingtalk\Exceptions\RuntimeException;

class User
{
    /**
     * @var \PcbDingtalk\Client
     */
    protected $client;

    /**
     * @var \PcbDingtalk\Services\AccessToken
     */
    protected $accessToken;

    /**
     * @param \PcbDingtalk\Client $client
     * @param \PcbDingtalk\Services\AccessToken $accessToken
     */
    public function __construct($client, $accessToken)
    {
        $this->client = $client;

        $this->accessToken = $accessToken;
    }

    /**
     * @param string $userId
     * @return array
     * @throws \PcbDingtalk\Exceptions\RuntimeException
     * @see https://open.dingtalk.com/document/orgapp/query-user-details
     */
    public function getUser($userId)
    {
        $token = $this->accessToken->getAccessToken();

        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/v2/user/get', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $token,
            ],
            'json' => [
                'userid' => $userId,
                'language' => 'zh_CN',
            ]
        ]);

        if ($body['errcode'] != 0) {
            throw new RuntimeException($body['errmsg'], $body['errcode']);
        }

        return $body['result'];
    }

    /**
     * @param string $phone
     * @return array
     * @throws \PcbDingtalk\Exceptions\RuntimeException
     * @see https://open.dingtalk.com/document/orgapp/query-users-by-phone-number
     */
    public function getUserByPhone($phone)
    {
        $token = $this->accessToken->getAccessToken();

        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/v2/user/getbymobile', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $token,
            ],
            'json' => [
                'mobile' => $phone,
            ]
        ]);

        if ($body['errcode'] != 0) {
            throw new RuntimeException($body['errmsg'], $body['errcode']);
        }

        return $body['result'];
    }

    /**
     * @param string $unionId
     * @return array
     * @throws \PcbDingtalk\Exceptions\RuntimeException
     * @see https://open.dingtalk.com/document/orgapp/query-a-user-by-the-union-id
     */
    public function getUserByUnionId($unionId)
    {
        $token = $this->accessToken->getAccessToken();

        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/user/getbyunionid', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $token,
            ],
            'json' => [
                'unionid' => $unionId,
            ]
        ]);

        if ($body['errcode'] != 0) {
            throw new RuntimeException($body['errmsg'], $body['errcode']);
        }

        return $body['result'];
    }
}
