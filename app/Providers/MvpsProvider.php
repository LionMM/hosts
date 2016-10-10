<?php
/**
 * Created by PhpStorm.
 * User: snovidov
 * Date: 10.10.16
 * Time: 17:26
 */

namespace App\Providers;


class MvpsProvider extends TargetProviderAbstract
{
    protected $source_url = 'http://winhelp2002.mvps.org/hosts.txt';
}