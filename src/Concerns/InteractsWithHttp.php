<?php

namespace PcbDingtalk\Concerns;

trait InteractsWithHttp
{
    /**
     * @param string $uri
     * @param array $options
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpGet($uri, $options = [])
    {
        $response = $this->http->request('GET', $uri, $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $uri
     * @param array $options
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function httpPost($uri, $options = [])
    {
        $response = $this->http->request('POST', $uri, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}
