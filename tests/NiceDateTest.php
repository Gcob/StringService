<?php

use gcob\StringService\NiceDate;
use PHPUnit\Framework\TestCase;

class NiceDateTest extends TestCase
{
    public function testDates()
    {
        $date = new DateTime("2021-08-03 12:00:00");
        $niceDate = new NiceDate($date, "fr");

        $this->assertEquals("3 Août 2021", $niceDate->format("j F Y"));
    }

}
