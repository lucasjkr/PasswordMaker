<?php

namespace Lucasjkr\PasswordMaker;

class Custom {

    private $uppers;
    private $lowers;
    private $numbers;
    private $symbols;

    private $letter;
    private $number;
    private $symbol;

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

    public function __construct()
    {
        // characters omitted from possible passwords include:
        // i, I, l, L, 1, |
        // 0, o, O
        // &, %, <, >

        $this->letter    = 'abcdefghjkmnpqrstuvwxyz';
        $this->number    = '23456789';
        $this->symbol    = '!@#$^*()-_=+~[]{}/\,.?';
    }

	public function generate()
    {
		$result = '';

        for ($i = 1; $i <= $this->uppers; $i++)
        {
            $result .= $this->charUpper();
        }

        for ($i = 1; $i <= $this->lowers; $i++)
        {
            $result .= $this->charLower();
        }

        for ($i = 1; $i <= $this->numbers; $i++)
        {
            $result .= $this->charNumber();
        }

        for ($i = 1; $i <= $this->symbols; $i++)
        {
            $result .= $this->charSymbol();
        }

		return str_shuffle($result);
	}

	// returns a lowercase letter
	private function charLower()
    {
		$max    = strlen($this->letter) - 1;
		return $this->letter[random_int(0, $max)];
	}

    // returns an uppercase letter
    private function charUpper()
    {
		return ucfirst($this->charLower());
	}

    private function charNumber()
    {
        $max    = strlen($this->number) - 1;
		return $this->number[random_int(0, $max)];
	}

    private function charSymbol()
    {
		$max    = strlen($this->symbol) - 1;
		return $this->symbol[random_int(0, $max)];
	}
}