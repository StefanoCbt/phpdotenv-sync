<?php

namespace Stefanocbt\PhpdotenvSync\Services;

class OutputStringsService
{
    /**
     * @param string $missingParamName
     * @param string|null $missingParamValue
     * @return string
     */
    public static function getMissingDotenvParamString(string $missingParamName, string $missingParamValue = null)
    {
        $missingDotenvParamString = $missingParamName;

        if (!empty($missingParamValue)) {
            $missingDotenvParamString .= ' (default: "' . $missingParamValue . '")';
        }

        return $missingDotenvParamString;
    }
}
