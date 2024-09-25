<?php

namespace PcbDingtalk\Services;

use PcbDingtalk\Exceptions\RuntimeException;

class SceneGroup
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
     * @param string $title
     * @param string $templateId
     * @param string $ownerUserId
     * @param array $memberUserIds
     * @return array
     * @throws \PcbDingtalk\Exceptions\RuntimeException
     * @see https://open.dingtalk.com/document/isvapp/create-group
     */
    public function create($title, $templateId, $ownerUserId, $memberUserIds = [])
    {
        $token = $this->accessToken->getAccessToken();

        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/im/chat/scenegroup/create', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $token,
            ],
            'json' => [
                'title' => $title,
                'template_id' => $templateId,
                'owner_user_id' => $ownerUserId,
                'user_ids' => implode(',', [$ownerUserId, ...$memberUserIds]),
            ],
        ]);

        if ($body['errcode'] != 0) {
            throw new RuntimeException($body['errmsg'], $body['errcode']);
        }

        return $body['result'];
    }
}
