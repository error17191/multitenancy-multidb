<?php

namespace App\Tenants\Cache;

use App\Tenants\Manager;
use Illuminate\Cache\CacheManager as BaseCacheManager;

/** @noinspection PhpHierarchyChecksInspection */
class CacheManager extends BaseCacheManager
{
    /**
     * Dynamically call the default driver instance.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if ($method === 'tags') {
            return $this->store()->tags(
                array_merge($this->getTenantCacheTag(), ...$parameters)
            );
        }

        return $this->store()->tags($this->getTenantCacheTag())->$method(...$parameters);
    }

    protected function getTenantCacheTag()
    {
        return ['tenant_' . $this->app[Manager::class]->getTenant()->uuid];
    }
}