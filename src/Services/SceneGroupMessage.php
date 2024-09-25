<?php

namespace PcbDingtalk\Services;

use PcbDingtalk\Enums\SceneGroupMessageTemplateEnum;
use PcbDingtalk\Exceptions\RuntimeException;

class SceneGroupMessage
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
     * @param string $template
     * @param array $data
     * @param string $robotId
     * @param string $sceneGroupId
     * @param bool $isAtAll
     * @param array|string $atUsers
     * @return void
     * @throws \PcbDingtalk\Exceptions\RuntimeException
     * @see https://open.dingtalk.com/document/orgapp/send-group-helper-message
     */
    public function send($template, $data, $robotId, $sceneGroupId, $isAtAll = false, $atUsers = [])
    {
        $token = $this->accessToken->getAccessToken();

        $jsonArr = $this->buildJsonArray($template, $data, $robotId, $sceneGroupId, $isAtAll, $atUsers);

        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/im/chat/scencegroup/message/send_v2', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $token,
            ],
            'json' => $jsonArr,
        ]);

        if ($body['errcode'] != 0) {
            throw new RuntimeException($body['errmsg'], $body['errcode']);
        }
    }

    /**
     * @param string $template
     * @param array $data
     * @param string $robotId
     * @param string $sceneGroupId
     * @param bool $isAtAll
     * @param array|string $atUsers
     * @return array
     */
    protected function buildJsonArray($template, $data, $robotId, $sceneGroupId, $isAtAll = false, $atUsers = [])
    {
        $jsonArr = [
            'robot_code' => $robotId,
            'target_open_conversation_id' => $sceneGroupId,
            'is_at_all' => $isAtAll,
            'at_users' => is_array($atUsers) ? implode(',', $atUsers) : $atUsers,
            'msg_template_id' => 'inner_app_template_text',
            'msg_param_map' => [],
            'msg_media_id_param_map' => [],
        ];

        switch ($template) {
            case SceneGroupMessageTemplateEnum::INNER_APP_TEMPLATE_PHOTO:
                $jsonArr['msg_media_id_param_map'] = json_encode($data);
                break;

            default:
                $jsonArr['msg_param_map'] = json_encode($data);
                break;
        }

        return array_filter($jsonArr);
    }
}
