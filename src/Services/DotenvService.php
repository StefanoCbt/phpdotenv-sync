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
        $srcDotenvParams = $this->parseDotenvFile($srcPath);

        $destDotenvParams = $this->parseDotenvFile($destPath);

        return array_diff_key(
            $srcDotenvParams,
            $destDotenvParams
        );
    }

    public function addDotenvParam(string $paramName, string $paramValue, string $destPath)
    {
        // TODO...
    }
}
