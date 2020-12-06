<?php

namespace Stefanocbt\PhpdotenvSync\Services;

class CommandExecutorService
{
    const ASK_DOTENV_PARAM_ACTION_COPY_DEFAULT_VALUE = 'y';
    const ASK_DOTENV_PARAM_ACTION_CHANGE_DEFAULT_VALUE = 'c';
    const ASK_DOTENV_PARAM_ACTION_SKIP = 's';

    const ASK_DOTENV_PARAM_ACTION_LABELS = [
        self::ASK_DOTENV_PARAM_ACTION_COPY_DEFAULT_VALUE => 'Copy the default value',
        self::ASK_DOTENV_PARAM_ACTION_CHANGE_DEFAULT_VALUE => 'Change the default value',
        self::ASK_DOTENV_PARAM_ACTION_SKIP => 'Skip',
    ];

    /**
     * @return string
     */
    public static function askForNewDotenvValue()
    {
        $question = 'Insert the new value:';

        CliColoredMessagesService::success($question);

        $handle = fopen("php://stdin", "r");

        $line = strtolower(trim(fgets($handle)));

        fclose($handle);

        return $line;
    }

    /**
     * @param string $paramName
     * @param string|null $defaultValue
     * @return false|string
     */
    public static function askForDotenvParam(string $paramName, string $defaultValue = null)
    {
        $question = '"' . $paramName . '"' . ' param is not present into your destination DOTENV file.';
        $question .= ' Its default value is "' . $defaultValue . '".';
        $question .= ' Would you like to add it? [Default action: copy the default value]';

        CliColoredMessagesService::success($question);

        /**
         * actions printing
         */
        foreach (self::ASK_DOTENV_PARAM_ACTION_LABELS as $actionValue => $actionLabel) {
            CliColoredMessagesService::info('[', false);
            CliColoredMessagesService::warning($actionValue, false);
            CliColoredMessagesService::info('] ' . $actionLabel, false);
            CliColoredMessagesService::info('');
        }

        $handle = fopen("php://stdin", "r");

        $line = strtolower(trim(fgets($handle)));

        fclose($handle);

        if (!array_key_exists($line, self::ASK_DOTENV_PARAM_ACTION_LABELS)) {
            return false;
        }

        return $line;
    }
}
