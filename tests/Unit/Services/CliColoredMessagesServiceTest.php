<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use \Mockery as m;
use Stefanocbt\PhpdotenvSync\Services\CliColoredMessagesService;

class CliColoredMessagesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        m::close();
    }

    /**
     * @dataProvider generalSameStringsProvider
     */
    public function testInfo(
        $expected,
        string $message
    )
    {
        $this->expectOutputString($expected . PHP_EOL);

        CliColoredMessagesService::info($message);
    }

    /**
     * @dataProvider generalSameStringsProvider
     */
    public function testDanger(
        $expected,
        string $message
    )
    {
        $this->expectOutputString("\033[31m$expected\033[0m" . PHP_EOL);

        CliColoredMessagesService::danger($message);
    }

    /**
     * @dataProvider generalSameStringsProvider
     */
    public function testWarning(
        $expected,
        string $message
    )
    {
        $this->expectOutputString("\033[0;33m$expected\033[0m" . PHP_EOL);

        CliColoredMessagesService::warning($message);
    }

    /**
     * @dataProvider generalSameStringsProvider
     */
    public function testSuccess(
        $expected,
        string $message
    )
    {
        $this->expectOutputString("\033[32m$expected\033[0m" . PHP_EOL);

        CliColoredMessagesService::success($message);
    }

    public function generalSameStringsProvider()
    {
        $data = [];

        $data[] = ['test text1', 'test text1'];
        $data[] = ['test text2', 'test text2'];
        $data[] = ['test text3', 'test text3'];
        $data[] = ['', ''];

        return $data;
    }
}
