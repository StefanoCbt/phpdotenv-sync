<?php

namespace Tests\Unit\Services;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;
use \Mockery as m;
use Stefanocbt\PhpdotenvSync\Services\DotenvService;

class DotenvServiceTest extends TestCase
{
    /** @var DotenvService */
    private $dotenvService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dotenvService = new DotenvService();
    }

    public function tearDown(): void
    {
        m::close();
    }

    public function testGetDotenvFilesDiff()
    {
        /**
         * test1
         */
        $rootFilesystem = vfsStream::setup();

        $srcAbsoluteFilePath = $rootFilesystem->url() . '/.env.example';
        $srcFileContent = '';
        $srcFileContent .= 'APP_NAME="My App"' . PHP_EOL;
        $srcFileContent .= 'APP_DEBUG=true' . PHP_EOL;
        $srcFileContent .= 'PARAM_WITHOUT_DEFAULT=' . PHP_EOL;
        $srcFileContent .= 'PARAM_WITH_DEFAULT="random value"' . PHP_EOL;
        file_put_contents($srcAbsoluteFilePath, $srcFileContent);

        $destAbsoluteFilePath = $rootFilesystem->url() . '/.env';
        $destFileContent = '';
        $destFileContent .= 'APP_NAME="My App"' . PHP_EOL;
        $destFileContent .= 'APP_DEBUG=true' . PHP_EOL;
        file_put_contents($destAbsoluteFilePath, $destFileContent);

        $this->assertEquals(
            [
                'PARAM_WITHOUT_DEFAULT' => '',
                'PARAM_WITH_DEFAULT' => 'random value',
            ],
            $this->dotenvService->getDotenvFilesDiff(
                $srcAbsoluteFilePath,
                $destAbsoluteFilePath
            )
        );

        /**
         * test2
         */
        $rootFilesystem = vfsStream::setup();

        $srcAbsoluteFilePath = $rootFilesystem->url() . '/.env.example';
        $srcFileContent = '';
        $srcFileContent .= 'APP_NAME="My App"' . PHP_EOL;
        $srcFileContent .= 'APP_DEBUG=true' . PHP_EOL;
        $srcFileContent .= 'PARAM_WITHOUT_DEFAULT=' . PHP_EOL;
        $srcFileContent .= 'PARAM_WITH_DEFAULT="random value"' . PHP_EOL;
        file_put_contents($srcAbsoluteFilePath, $srcFileContent);

        $destAbsoluteFilePath = $rootFilesystem->url() . '/.env';
        $destFileContent = '';
        $destFileContent .= 'APP_NAME="My App REAL"' . PHP_EOL;
        $destFileContent .= 'APP_DEBUG=false' . PHP_EOL;
        $destFileContent .= 'PARAM_WITHOUT_DEFAULT="param1"' . PHP_EOL;
        $destFileContent .= 'PARAM_WITH_DEFAULT="random value REAL"' . PHP_EOL;
        file_put_contents($destAbsoluteFilePath, $destFileContent);

        $this->assertEquals(
            [],
            $this->dotenvService->getDotenvFilesDiff(
                $srcAbsoluteFilePath,
                $destAbsoluteFilePath
            )
        );

        /**
         * test3
         */
        $rootFilesystem = vfsStream::setup();

        $srcAbsoluteFilePath = $rootFilesystem->url() . '/.env.example';
        $srcFileContent = '';
        $srcFileContent .= 'APP_NAME="My App"' . PHP_EOL;
        $srcFileContent .= 'APP_DEBUG=true' . PHP_EOL;
        $srcFileContent .= 'PARAM_WITHOUT_DEFAULT=' . PHP_EOL;
        file_put_contents($srcAbsoluteFilePath, $srcFileContent);

        $destAbsoluteFilePath = $rootFilesystem->url() . '/.env';
        $destFileContent = '';
        $destFileContent .= 'APP_NAME="My App REAL"' . PHP_EOL;
        $destFileContent .= 'APP_DEBUG=false' . PHP_EOL;
        $destFileContent .= 'PARAM_WITHOUT_DEFAULT="param1"' . PHP_EOL;
        $destFileContent .= 'PARAM_WITH_DEFAULT="random value REAL"' . PHP_EOL;
        file_put_contents($destAbsoluteFilePath, $destFileContent);

        $this->assertEquals(
            [],
            $this->dotenvService->getDotenvFilesDiff(
                $srcAbsoluteFilePath,
                $destAbsoluteFilePath
            )
        );

        /**
         * test3
         */
        $rootFilesystem = vfsStream::setup();

        $srcAbsoluteFilePath = $rootFilesystem->url() . '/.env.randomname';
        $srcFileContent = '';
        $srcFileContent .= 'APP_NAME="My App"' . PHP_EOL;
        $srcFileContent .= 'APP_DEBUG=true' . PHP_EOL;
        $srcFileContent .= 'PARAM_WITHOUT_DEFAULT=' . PHP_EOL;
        $srcFileContent .= 'RANDOM_PARAM=RANDOMDEFAULTVALUE' . PHP_EOL;
        file_put_contents($srcAbsoluteFilePath, $srcFileContent);

        $destAbsoluteFilePath = $rootFilesystem->url() . '/.envrandomname';
        $destFileContent = '';
        $destFileContent .= 'APP_NAME="My App REAL"' . PHP_EOL;
        $destFileContent .= 'APP_DEBUG=false' . PHP_EOL;
        $destFileContent .= 'PARAM_WITHOUT_DEFAULT="param1"' . PHP_EOL;
        file_put_contents($destAbsoluteFilePath, $destFileContent);

        $this->assertEquals(
            [
                'RANDOM_PARAM' => 'RANDOMDEFAULTVALUE',
            ],
            $this->dotenvService->getDotenvFilesDiff(
                $srcAbsoluteFilePath,
                $destAbsoluteFilePath
            )
        );
    }
}
