<?php
namespace Juno;

use Symfony\Component\Console\Application as BaseAppliation;

class Application extends BaseAppliation
{
    private static $logo = "
__     __      _______             _
\ \   / /     |__   __|           | |
 \ \_/ /__  _   _| |_ __ __ _  ___| | __
  \   / _ \| | | | | '__/ _` |/ __| |/ /
   | | (_) | |_| | | | | (_| | (__|   <
   |_|\___/ \__,_|_|_|  \__,_|\___|_|\_\
    ";

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct("YouTrack CLI", "0.1.0");
    }

    public function getHelp()
    {
        return self::$logo . parent::getHelp();
    }
}