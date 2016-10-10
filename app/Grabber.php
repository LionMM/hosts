<?php

namespace App;


use App\Providers\ProvidersFabric;

class Grabber
{
    const IP = '0.0.0.0';


    public function renewFile()
    {
        $big_list = $this->getAll();

        echo ' got ' . count($big_list) . ' lines' . PHP_EOL;
        $result = $this->prepareList($big_list);
        echo ' clear got ' . count($result) . ' lines' . PHP_EOL;

        file_put_contents('./hosts.txt', implode(PHP_EOL, $result));
    }


    private function getAll()
    {
        $provider = new ProvidersFabric();

        $list = [];
        foreach ($provider->getTargets() as $target) {
            $data = $provider->target($target)->getRawList();
            $list = array_merge($list, $data);

            echo ' provider: ' . $target . ', items: ' . count($data) . PHP_EOL;
        }

        return $list;
    }


    private function prepareList($array)
    {
        $array = array_unique($array);
        $array = $this->deleteExcludes($array);
        sort($array);

        $array = array_map(
            function ($value) {
                return self::IP . ' ' . $value;
            },
            $array
        );

        array_unshift($array, file_get_contents('./append.txt'), '', '');
        array_unshift($array, '#', '# Last updated: ' . date('Y.m.d H:i:s'), '#', '');

        return $array;
    }

    private function deleteExcludes($array)
    {
        $excludes = file('./excludes.txt');
        foreach ($excludes as $exclude) {
            $key = array_search(trim($exclude), $array);
            if ($key !== false) {
                unset($array[$key]);
            }
        }
        return $array;
    }
}