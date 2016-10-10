<?php
/**
 * Created by PhpStorm.
 * User: snovidov
 * Date: 10.10.16
 * Time: 17:27
 */

namespace App\Providers;


abstract class TargetProviderAbstract implements ProvidersInterface
{
    protected $source_url;

    public function getRawList()
    {
        $lines = $this->getUrlContent($this->source_url);
        $hosts = [];
        foreach ($lines as $line) {
            if (substr($line, 0, 1) != '#') {
                $host = false;
                if (substr_count($line, ' ')) {
                    list($ip, $host) = explode(' ', $line);
                }

                if ($host) {
                    $hosts[] = $host;
                }
            }
        }
        return $hosts;
    }

    /**
     * @param $url
     * @return array
     */
    private function getUrlContent($url)
    {
        $file_contents = file_get_contents($url);
        $lines         = [];

        if ($file_contents) {
            $file_contents_array = explode("\n", $file_contents);
            foreach ($file_contents_array as $line) {
                $line = trim($line);
                if ($line) {
                    $line    = str_replace("\t", ' ', $line);
                    $line    = preg_replace('!\s+!', ' ', $line);
                    $lines[] = $line;
                }
            }
        }

        return $lines;
    }
}