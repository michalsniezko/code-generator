<?php

namespace App\Tests\Service;

use App\Service\CodeGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CodeGeneratorText extends KernelTestCase
{
    /** @test */
    public function testAdd()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();

        $generatorService = $container->get(CodeGenerator::class);
        $this->assertEquals(42, 42);

    }

}