<?php

namespace gcob\StringService;

use DateTime;
use Transliterator;

class StringService
{

    private static $instance;

    private ?array $accents = null;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function kebabEncode(string $input, bool $areSpecialCharsSpaces = true): string
    {
        if (empty($input)) {
            return "";
        }

        $output = $this->removeAccents($input);
        $output = strtolower($output);
        $output = preg_replace('/[^a-z0-9\- ]/', $areSpecialCharsSpaces ? "-" : "", $output);
        $output = str_replace(" ", "-", $output);
        $output = preg_replace('/-+/', '-', $output);
        $output = trim($output, "-");

        return $output;
    }

    public function snakeEncode(string $input, bool $areSpecialCharsSpaces = true): string
    {
        if (empty($input)) {
            return "";
        }

        $output = $this->kebabEncode($input, $areSpecialCharsSpaces);
        $output = str_replace('-', '_', $output);

        return $output;
    }

    public function camelEncode(string $input, bool $areSpecialCharsSpaces = true): string
    {
        if (empty($input)) {
            return "";
        }

        $tmp = $this->kebabEncode($input, $areSpecialCharsSpaces);
        $tmp = explode('-', $tmp);

        if (count($tmp) == 1) {
            return $tmp[0];
        }

        $output = $tmp[0];

        for ($i = 1; $i < count($tmp); $i++) {
            $output .= ucfirst($tmp[$i]);
        }

        return $output;
    }

    /**
     * Source : https://dev.to/bdelespierre/convert-accentuated-character-to-their-ascii-equivalent-in-php-3kf1
     */
    public function removeAccents(string $input, string $charset = 'utf-8'): string
    {
        $input = htmlentities($input, ENT_NOQUOTES, $charset);
        $input = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $input);
        $input = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $input);

        return preg_replace('#&[^;]+;#', '', $input);
    }

}