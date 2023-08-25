<?php

namespace gcob\StringService;

use DateTime;

class NiceDate
{
    public string $fallbackLocale = "en";

    public DateTime $date;
    public string $locale; // Accepts ISO language code with or without ISO country code. Ex.: "fr" or "fr_CA". Note that at the moment, ISO country is simply ignored.

    public function __construct(DateTime $date, string $locale = "en")
    {
        $this->date = $date;
        $this->locale = $locale;
    }

    /**
     * @param string $format // https://www.php.net/manual/en/datetime.format.php
     * @return string
     */
    public function format(string $format = "j F Y, H \h i"): string
    {
        $local = substr($this->locale, 0, 2);
        $monthsFile = __DIR__ . "/locales/$local/months.php";

        if (!file_exists($monthsFile)) {
            $fallbackLocale = substr($this->fallbackLocale, 0, 2);
            $monthsFile = require __DIR__ . "/locales/" . $fallbackLocale . "/months.php";
        }

        $months = (!file_exists($monthsFile)) ? [] : require $monthsFile;

        $dateFormatted = $this->date->format($format);

        $dateFormatted = preg_replace_callback(
            '/\b(?:' . implode('|', array_keys($months)) . ')\b/',
            function ($match) use ($months) {
                return $months[$match[0]];
            },
            $dateFormatted
        );

        return $dateFormatted;
    }
}