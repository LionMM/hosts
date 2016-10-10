<?php
/**
 * Created by PhpStorm.
 * User: snovidov
 * Date: 10.10.16
 * Time: 17:27
 */

namespace App\Providers;


class ProvidersFabric
{
    private $targets = [
        'adaway'            => AdawayProvider::class,
        'mvps'              => MvpsProvider::class,
        'someonewhocares'   => SomeonewhocaresProvider::class,
        'yoyo'              => YoyoProvider::class,
        'malwaredomainlist' => MalwaredomainlistProvider::class,
    ];

    private $instances = [];

    /**
     * @param string $target_alias
     * @return ProvidersInterface
     * @throws \Exception
     */
    public function target($target_alias)
    {
        if (!isset($this->targets[$target_alias])) {
            throw new \Exception('There is no target handler');
        }

        if (!isset($this->instances[$target_alias])) {
            $this->instances[$target_alias] = new $this->targets[$target_alias];
        }

        return $this->instances[$target_alias];
    }

    public function getTargets()
    {
        return array_keys($this->targets);
    }
}