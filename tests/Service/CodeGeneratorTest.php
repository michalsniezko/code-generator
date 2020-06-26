<?php

namespace App\Tests\Service;

use App\Service\CodeGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CodeGeneratorTest extends KernelTestCase
{
    /** @var CodeGenerator $generator */
    private $generator;

    protected function setUp()
    {
        self::bootKernel();
        $container = self::$container;
        $this->generator = $container->get(CodeGenerator::class);
    }

    public function testItGeneratesProperAmountOfCodes()
    {
        $amountOfCodes = rand(1, 500);
        $filePath = $this->generator->getFileWithCodes($amountOfCodes, rand(1, 10));
        $contents = file_get_contents($filePath);
        $codesArray = explode(PHP_EOL, $contents);
        $this->assertCount($amountOfCodes, $codesArray);
    }

    public function testItGeneratesCodesWithProperLength()
    {
        $length = rand(1, 500);
        $filePath = $this->generator->getFileWithCodes(rand(1, 500), $length);
        $contents = file_get_contents($filePath);
        $codesArray = explode(PHP_EOL, $contents);

        foreach ($codesArray as $code) {
            $this->assertEquals($length, strlen($code));
        }
    }

    public function testItGeneratesOnlyUniqueCodes()
    {
        $filePath = $this->generator->getFileWithCodes(rand(1, 500), rand(1, 500));
        $contents = file_get_contents($filePath);
        $codesArray = explode(PHP_EOL, $contents);
        $this->assertEquals(count($codesArray), count(array_unique($codesArray)));
    }
}
