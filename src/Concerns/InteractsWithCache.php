<?php

namespace PcbDingtalk\Concerns;

trait InteractsWithCache
{
    /**
     * @param array $credentials
     * @param string $prefix
     * @return string
     */
    public function buildCacheKey($credentials, $prefix = '')
    {
        return $prefix . md5(json_encode($credentials));
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getFromCache($key, $default = null)
    {
        return $this->cache->get($key, $default);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param null|int $ttl
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function putInCache($key, $value, $ttl = null)
    {
        return $this->cache->set($key, $value, $ttl);
    }

    /**
     * @param string $key
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function deleteFromCache($key)
    {
        return $this->cache->delete($key);
    }

    /**
     * @param string $key
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function hasInCache($key)
    {
        return $this->cache->has($key);
    }
}
