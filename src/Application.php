<?php

namespace PcbDingtalk;

use GuzzleHttp\Client as HttpClient;
use PcbDingtalk\Services\AccessToken;
use PcbDingtalk\Services\OAuth;
use PcbDingtalk\Services\SceneGroup;
use PcbDingtalk\Services\SceneGroupMessage;
use PcbDingtalk\Services\User;
use PcbDingtalk\Services\UserAccessToken;
use PcbDingtalk\Services\UserProfile;

/**
 * @method \PcbDingtalk\Services\AccessToken       makeAccessToken()
 * @method \PcbDingtalk\Services\OAuth             makeOAuth()
 * @method \PcbDingtalk\Services\SceneGroup        makeSceneGroup()
 * @method \PcbDingtalk\Services\SceneGroupMessage makeSceneGroupMessage()
 * @method \PcbDingtalk\Services\UserAccessToken   makeUserAccessToken()
 * @method \PcbDingtalk\Services\User              makeUser()
 * @method \PcbDingtalk\Services\UserProfile       makeUserProfile()
 */
class Application
{
    /**
     * @var \PcbDingtalk\Client
     */
    protected $client;

    /**
     * @param array $config
     * @param \Psr\SimpleCache\CacheInterface $cache
     */
    public function __construct($config, $cache)
    {
        $http = new HttpClient();

        $this->client = new Client($config, $cache, $http);
    }

    /**
     * @return \PcbDingtalk\Services\AccessToken
     */
    public function makeAccessToken()
    {
        return new AccessToken($this->client);
    }

    /**
     * @return \PcbDingtalk\Services\OAuth
     */
    public function makeOAuth()
    {
        return new OAuth($this->client);
    }

    /**
     * @return \PcbDingtalk\Services\SceneGroup
     */
    public function makeSceneGroup()
    {
        $accessToken = $this->makeAccessToken();

        return new SceneGroup($this->client, $accessToken);
    }

    /**
     * @return \PcbDingtalk\Services\SceneGroupMessage
     */
    public function makeSceneGroupMessage()
    {
        $accessToken = $this->makeAccessToken();

        return new SceneGroupMessage($this->client, $accessToken);
    }

    /**
     * @return \PcbDingtalk\Services\User
     */
    public function makeUser()
    {
        $accessToken = $this->makeAccessToken();

        return new User($this->client, $accessToken);
    }

    /**
     * @return \PcbDingtalk\Services\UserAccessToken
     */
    public function makeUserAccessToken()
    {
        return new UserAccessToken($this->client);
    }

    /**
     * @return \PcbDingtalk\Services\UserProfile
     */
    public function makeUserProfile()
    {
        return new UserProfile($this->client);
    }
}
