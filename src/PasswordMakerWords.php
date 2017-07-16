<?php

namespace Lucasjkr\PasswordMaker;

class Words
{
    private $dictionary;

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    public function generate($number_of_words) {
        $result = '';
        for ($i = 1; $i <= $number_of_words; $i++) {
            $result .= $this->randomWord() . " ";
        }
        return trim($result);
    }

    private function randomWord() {
        $filename = $this->dictionary;
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        $words = explode("\r", $contents);
        $result = strtolower($words[rand(0, count($words)-1)]);
        return $result;
    }

}