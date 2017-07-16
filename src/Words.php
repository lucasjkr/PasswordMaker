<?php

namespace Lucasjkr\PasswordMaker;

class Words
{
    private $dictionary;
    public $leetify = false;
    public $chance   = 100;

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

        if($this->leetify == true){
            return $this->leetChars($result);
        }

        return $result;
    }

    private function randomWord() {
        $filename = $this->dictionary;
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        $words = explode("\r", $contents);
        $result = strtolower($words[random_int(0, count($words)-1)]);
        return $result;
    }

    private function leetChars($string){
        $chars  = str_split($string);
        $result = '';

        foreach ($chars as $c) {
            $r       = random_int(0, 100);
            $input   = array('a', 'b', 'e', 'g', 'i', 'l', 'o', 's', 't');
            $output  = array('4', '8', '3', '6', '!', '1', '0', '5', '7');

            if($r <= $this->chance) {
                $result .= str_replace($input, $output, $c);
            } else {
                $result .= $c;
            }

        }

        return $result;
    }
}