<?php

use gcob\StringService\StringService;
use PHPUnit\Framework\TestCase;

class StringServiceTest extends TestCase
{
    public function testKebab()
    {
        $stringService = StringService::getInstance();
        $input = "  Ma  -chaine##!   PÀS ENcodé     ";
        $expectedOutput = "ma-chaine-pas-encode";

        $output = $stringService->kebabEncode($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testSnake()
    {
        $stringService = StringService::getInstance();
        $input = "  Ma  -chaine##!   PÀS ENcodé     ";
        $expectedOutput = "ma_chaine_pas_encode";

        $output = $stringService->snakeEncode($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testCamel()
    {
        $stringService = StringService::getInstance();
        $input = "  Ma  -chaine##!   PÀS ENcodé     ";
        $expectedOutput = "maChainePasEncode";

        $output = $stringService->camelEncode($input);

        $this->assertEquals($expectedOutput, $output);
    }
}
