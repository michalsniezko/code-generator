<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;

class CodeGenerator
{
    /** @var string  */
    private $inputSeed = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    /**
     * @param int $numberOfCodes
     * @param int $codeLength
     * @param string|null $filePath
     * @return string
     */
    public function getFileWithCodes(int $numberOfCodes, int $codeLength, string $filePath = null): string
    {
        return $this->prepareFile($this->generateCodes($numberOfCodes, $codeLength), $filePath);
    }

    /**
     * @param int $numberOfCodes
     * @param int $codeLength
     * @return string
     */
    private function generateCodes(int $numberOfCodes, int $codeLength): string
    {
        $this->prepareSeed($codeLength);

        $result = [];
        for ($i = 0; $i < $numberOfCodes; $i++) {
            $code = $this->generateRandomCode($codeLength);
            while (in_array($code, $result)) {
                $code = $this->generateRandomCode($codeLength);
            }
            $result[] = $code;
        }

        return implode(PHP_EOL, $result);
    }

    /**
     * @param int $length
     */
    private function prepareSeed(int $length): void
    {
        while (strlen($this->inputSeed) < $length) {
            $this->inputSeed .= $this->inputSeed[rand(0, strlen($this->inputSeed)-1)];
        }
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomCode(int $length): string
    {
        return substr(str_shuffle($this->inputSeed), 0, $length);
    }

    /**
     * @param string $contents
     * @param string|null $filepath
     * @return string
     */
    private function prepareFile(string $contents, ?string $filepath): string
    {
        $filesystem = new Filesystem();
        if (!$filepath) {
            $filepath = $filesystem->tempnam('/tmp', 'temp_codes_');
        }
        $filesystem->dumpFile($filepath, $contents);

        return $filepath;
    }
}
