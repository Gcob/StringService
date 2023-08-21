<?php

namespace gcob\StringService;

use Transliterator;

class StringService
{
    private static $instance;

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

    public function kebabEncode(string $input): string
    {
        if (empty($input)) {
            return "";
        }

        $output = iconv('UTF-8', 'ASCII//TRANSLIT', $input);
        $output = strtolower($output);
        $output = trim($output, " \t\n\r");
        $output = preg_replace('/\s+/', '-', $output);
        $output = preg_replace('/-+/', '-', $output);
        $output = preg_replace('/[^a-z0-9\s\-]/', '', $output);

        return $output;
    }

    public function snakeEncode(string $input): string
    {
        if (empty($input)) {
            return "";
        }

        $output = $this->kebabEncode($input);
        $output = str_replace('-', '_', $output);

        return $output;
    }

    public function camelEncode(string $input): string
    {
        if (empty($input)) {
            return "";
        }

        $tmp = $this->kebabEncode($input);
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

}