<?php

use gcob\StringService\StringService;
use PHPUnit\Framework\TestCase;

class StringServiceTest extends TestCase
{
    const chaine1 = "  Ma  -chaine##!   PÀS ENcodé     ";
    const chaine2 = "à;À";
    const chaine3 = " Au-delà des genres ";

    public function testKebab()
    {
        $stringService = StringService::getInstance();

        $this->assertEquals("ma-chaine-pas-encode", $stringService->kebabEncode(self::chaine1));
        $this->assertEquals("a-a", $stringService->kebabEncode(self::chaine2));
        $this->assertEquals("au-dela-des-genres", $stringService->kebabEncode(self::chaine3));
    }

    public function testSnake()
    {
        $stringService = StringService::getInstance();
        $expectedOutput = "ma_chaine_pas_encode";

        $output = $stringService->snakeEncode(self::chaine1);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testCamel()
    {
        $stringService = StringService::getInstance();
        $expectedOutput = "maChainePasEncode";

        $output = $stringService->camelEncode(self::chaine1);

        $this->assertEquals($expectedOutput, $output);
    }

}
