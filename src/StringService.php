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

        $output = $this->removeAccents($input);
        $output = strtolower($output);
        $output = trim($output, " \t\n\r");
        $output = preg_replace('/\s+/', '-', $output);
        $output = preg_replace('/[^a-z0-9\-]/', '-', $output);
        $output = preg_replace('/-+/', '-', $output);

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

    function removeAccents(string $input): string
    {
        $accents = array(
            'à' => 'a', 'â' => 'a', 'ä' => 'a', 'á' => 'a', 'ã' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'î' => 'i', 'ï' => 'i', 'í' => 'i',
            'ö' => 'o', 'ô' => 'o', 'ò' => 'o', 'ó' => 'o', 'õ' => 'o',
            'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ú' => 'u',
            'ç' => 'c', 'ñ' => 'n',

            'À' => 'A', 'Â' => 'A', 'Ä' => 'A', 'Á' => 'A', 'Ã' => 'A',
            'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'Î' => 'I', 'Ï' => 'I', 'Í' => 'I',
            'Ö' => 'O', 'Ô' => 'O', 'Ò' => 'O', 'Ó' => 'O', 'Õ' => 'O',
            'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ú' => 'U',
            'Ç' => 'C', 'Ñ' => 'N'
        );

        return strtr($input, $accents);
    }

}