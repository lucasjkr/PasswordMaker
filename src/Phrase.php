<?php

namespace Lucasjkr\PasswordMaker;

class Phrase
{
    /********************************************************************************/
    /*                                                                              */
    /*   $leetify - set to true to turn on "hacker" character swapping              */
    /*                                                                              */
    /*   $chance  - only applies if $leetify is true, allows user to specify        */
    /*              likelihood that each substitutable character actually gets      */
    /*              subsituted                                                      */
    /*                                                                              */
    /*   $capitalize - set to true to capitalize each word                          */
    /*                                                                              */
    /********************************************************************************/

    public $leetify    = false;
    public $chance     = 100;
    public $capitalize = false;

    // path to the dictionary file
    private $textfile;

    // This is where the dictionary will get loaded into
    private $wordArray = array();

    public function __get($property)
    {
        if (property_exists($this, $property))
        {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    // constructor takes the dictionary file as input. This should be a text file with a single entry per line.
    public function __construct($textfile)
    {
        $this->textfile  = $textfile;
        $this->wordArray = $this->createArrayFromInputFile();
    }

    // the controller (or whatever feeds data into this function) should check to make sure an outlandishly large
    // number isn't provided as input, as it will probably kill the server!
    public function generate($numberOfWords) {
        $result = '';

        // generate a series of randomly selected words
        for ($i = 1; $i <= $numberOfWords; $i++)
        {
            $result .= $this->randomWord() . " ";
        }

        // apply optional capitalization transformation
        if($this->capitalize == true)
        {
            $result = ucwords($result);
        }

        // apply optional 'leetification' of the string
        if($this->leetify == true)
        {
            return $this->leetChars($result);
        }

        return $result;
    }

    private function loadDictionary()
    {
        $filename = $this->textfile;
        $handle = fopen($filename, "r");
        $result = fread($handle, filesize($filename));
        fclose($handle);
        return $result;
    }

    private function createArrayFromInputFile()
    {
        $dictionary = $this->loadDictionary();
        return explode("\r", $dictionary);
    }

    private function randomWord()
    {
        $words  = $this->wordArray;
        return strtolower($words[random_int(0, count($words)-1)]);

    }

    private function leetChars($string)
    {
        $chars  = str_split($string);
        $result = '';

        foreach ($chars as $c) {
            $r       = random_int(1, 100);
            $input   = array('a', 'A', 'b', 'e', 'g', 'H', 'i', 'l', 'o', 's', 't', 'T');
            $output  = array('@', '4', '8', '3', '6', '#', '!', '1', '0', '5', '+', '7');

            if($r <= $this->chance) {
                $result .= str_replace($input, $output, $c);
            } else {
                $result .= $c;
            }
        }

        return $result;
    }
}