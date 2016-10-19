<?php

namespace App\Services;

abstract class BaseService
{

    /**
     * Creating slug by removing unwanted characters
     * 
     * @param string $string
     * @return string | boolean
     */
    static public function slugify($string, $removeDigits = false)
    {
        // replace non letter or digits by -
        if ($removeDigits) {
            $string = preg_replace('~[^\pL\d]+~u', '-', $string);
        } else {
            $string = preg_replace('~[^\pL\w]+~u', '-', $string);
        }

        // transliterate
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        // remove unwanted characters
        $string = preg_replace('~[^-\w]+~', '', $string);
        // trim
        $string = trim($string, '-');
        // remove duplicate -
        $string = preg_replace('~-+~', '-', $string);
        // lowercase
        $string = strtolower($string);
        if (empty($string)) {
            return false;
        }

        return $string;
    }

}