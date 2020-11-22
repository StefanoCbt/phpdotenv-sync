<?php

namespace Stefanocbt\PhpdotenvSync\Services;

class CliColoredMessagesService
{
    /**
     * @param string $message
     */
    public static function success(string $message)
    {
        echo "\033[32m$message\033[0m" . PHP_EOL;
    }

    /**
     * @param string $message
     */
    public static function warning(string $message)
    {
        echo "\033[0;33m$message\033[0m" . PHP_EOL;
    }

    /**
     * @param string $message
     */
    public static function danger(string $message)
    {
        echo "\033[31m$message\033[0m" . PHP_EOL;
    }

    /**
     * @param string $message
     */
    public static function info(string $message)
    {
        echo $message . PHP_EOL;
    }
}
