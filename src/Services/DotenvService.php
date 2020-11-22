<?php

namespace Stefanocbt\PhpdotenvSync\Services;

use Dotenv\Dotenv;

class DotenvService
{
    /**
     * @param $fileSrc
     * @return bool
     */
    protected function checkFileExists($fileSrc)
    {
        return file_exists($fileSrc);
    }

    /**
     * @param $filePath
     * @return array
     * @throws \Exception
     */
    protected function parseDotenvFile($filePath)
    {
        /**
         * checking file exists before parsing
         */
        if (!$this->checkFileExists($filePath)) {
            throw new \Exception('file ("' . $filePath . '") does not exists');
        }

        return Dotenv::parse(file_get_contents($filePath));
    }

    /**
     * @param string $srcPath
     * @param string $destPath
     * @return array
     * @throws \Exception
     */
    public function getDotenvFilesDiff(
        string $srcPath,
        string $destPath
    ) {
        /**
         * loading srcDotenvParams
         */
        $srcDotenvParams = $this->parseDotenvFile($srcPath);

        /**
         * loading destDotenvParams
         */
        $destDotenvParams = $this->parseDotenvFile($destPath);

        /**
         * returning the diff
         */
        return array_diff_key(
            $srcDotenvParams,
            $destDotenvParams
        );
    }
}
