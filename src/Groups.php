<?php

namespace Lucasjkr\PasswordMaker;

class Groups {

    /********************************************************************************/
    /*  PasswordMaker Version 1.1                                                   */
    /********************************************************************************/

    private $size;
    private $sets;
    private $delimiter;

    private $uppers = false;
    private $lowers = false;
    private $numbers = false;
    private $symbols = false;

    public function __construct()
    {

    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
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

	public function generate()
    {
        $result = '';
        $string = $this->makeString();
        $max    = strlen($string) - 1;

        for ($s = 1; $s <= $this->sets; $s++)
        {
            for ($z = 1; $z <= $this->size; $z++)
            {
                $result .= $string[random_int(0, $max)];
            }
            $result .=  $this->delimiter;
        }

        return trim($result, $this->delimiter);
	}

    private function makeString(){
        $string = '';

        if($this->lowers != false) {
            $string .= 'abcdefghjkmnpqrstuvwxyz';
        }

        if($this->uppers != false) {
            $string .= 'ABCDEFGHJKMNPQRSTUVWXYZ';
        }

        if($this->numbers != false) {
            $string .= '23456789';
        }

        if($this->symbols != false) {
            $string .= '!@#$^*-_=+,.?()/[]{}';
        }

        return $string;
    }
}