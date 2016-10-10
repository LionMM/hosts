<?php
/**
 * Created by PhpStorm.
 * User: snovidov
 * Date: 10.10.16
 * Time: 17:26
 */

namespace App\Providers;


class AdawayProvider extends TargetProviderAbstract
{
    protected $source_url = 'https://adaway.org/hosts.txt';
}