<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use \Mockery as m;
use Stefanocbt\PhpdotenvSync\OperationsStaticReference;

class OperationStaticReferenceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        m::close();
    }

    public function testArrayReferencesContainsAllConstants()
    {
        $allOptReferences = OperationsStaticReference::OPT_DOTENV_REFERENCES;

        $refrectionClass = new \ReflectionClass(OperationsStaticReference::class);
        $constants = $refrectionClass->getConstants();
        unset($constants["OPT_DOTENV_REFERENCES"]);

        foreach ($constants as $constantValue) {
            $this->assertContains(
                $constantValue,
                $allOptReferences
            );
        }
    }
}
