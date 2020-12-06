<?php

namespace Stefanocbt\PhpdotenvSync\Services;

class CliColoredMessagesService
{
    /**
     * @param string $message
     */
    public static function success(string $message, bool $appendNewline = true)
    {
        $message = "\033[32m$message\033[0m";
        if ($appendNewline) {
            $message .= PHP_EOL;
        }

        echo $message;
    }

    /**
     * @param string $message
     */
    public static function warning(string $message, bool $appendNewline = true)
    {
        $message = "\033[0;33m$message\033[0m";
        if ($appendNewline) {
            $message .= PHP_EOL;
        }

        echo $message;
    }

    /**
     * @param string $message
     */
    public static function danger(string $message, bool $appendNewline = true)
    {
        $message = "\033[31m$message\033[0m";
        if ($appendNewline) {
            $message .= PHP_EOL;
        }

        echo $message;
    }

    /**
     * @param string $message
     */
    public static function info(string $message, bool $appendNewline = true)
    {
        if ($appendNewline) {
            $message .= PHP_EOL;
        }

        echo $message;
    }
}
