<?php

use gcob\StringService\StringService;
use PHPUnit\Framework\TestCase;

class StringServiceTest extends TestCase
{
    public function testRemoveAccent()
    {
        $stringService = StringService::getInstance();

        $output = $stringService->removeAccents("éÉàÀùÙçÇ");

        $this->assertEquals("eEaAuUcC", $output);
    }

    public function testEncodeString()
    {
        $stringService = StringService::getInstance();
        $input = "  Ma  -chaine##!   PÀS ENcodé     ";
        $expectedOutput = "ma-chaine-pas-encode";

        $output = $stringService->encodeString($input);

        $this->assertEquals($expectedOutput, $output);
    }
}
