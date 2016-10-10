<?php
/**
 * Created by PhpStorm.
 * User: snovidov
 * Date: 10.10.16
 * Time: 17:26
 */

namespace App\Providers;


class YoyoProvider extends TargetProviderAbstract
{
    protected $source_url = 'http://pgl.yoyo.org/adservers/serverlist.php?hostformat=hosts&showintro=0&mimetype=plaintext';
}