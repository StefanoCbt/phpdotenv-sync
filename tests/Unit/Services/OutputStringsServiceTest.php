<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use \Mockery as m;
use Stefanocbt\PhpdotenvSync\Services\OutputStringsService;

class OutputStringsServiceTest extends TestCase
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
     * @dataProvider getMissingDotenvParamStringProvider
     */
    public function testGetMissingDotenvParamString(
        $expected,
        string $missingParamName,
        $missingParamValue
    )
    {
        $this->assertEquals(
            $expected,
            OutputStringsService::getMissingDotenvParamString($missingParamName, $missingParamValue)
        );
    }

    public function getMissingDotenvParamStringProvider()
    {
        $data = [];

        $data[] = ['PARAM1', 'PARAM1', null];
        $data[] = ['PARAM1 (default: "VALUE1")', 'PARAM1', 'VALUE1'];
        $data[] = ['PARAM_RANDOM (default: "RANDOM VALUE 1")', 'PARAM_RANDOM', 'RANDOM VALUE 1'];

        return $data;
    }
}
