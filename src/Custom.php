<?php

namespace Lucasjkr\PasswordMaker;

class Custom {

    private $uppers;
    private $lowers;
    private $numbers;
    private $symbols;

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

	public function generate(){
		$result = '';

        for ($i = 1; $i <= $this->uppers; $i++) {
            $result .= $this->charUpper();
        }

        for ($i = 1; $i <= $this->lowers; $i++) {
            $result .= $this->charlower();
        }

        for ($i = 1; $i <= $this->numbers; $i++) {
            $result .= $this->charNumber();
        }

        for ($i = 1; $i <= $this->symbols; $i++) {
            $result .= $this->charSymbol();
        }

		return str_shuffle($result);
	}

	private function charLower() {

	    // Returns a lowercase letter from A-Z, but
		// ommitting the characters i, l, and o from the
		// possibilities, because depending on the case,
		// they can be confused for 1 or 0

		$string = 'abcdefghjkmnpqrstuvwxyz';
		$max    = strlen($string) - 1;
		return $string[random_int(0, $max)];
	}

    private function charUpper() {
	    // returns an uppercase letter
		return strtoupper($this->charLower());
	}

    private function charNumber() {
		// Omit the character 1 and 0 from the possibilities,
		// because depending on the case,
		// they can be confused for l, i, or o

		$string = '23456789';
		$max    = strlen($string) - 1;
		return $string[random_int(0, $max)];
	}

    private function charSymbol() {
		// Omit quotes, double quotes, and ticks as they can
		// be confusing to read in some circumstances.

		$string = '!@#$%^&*()-_=+~[]{}|/\,.?';
		$max    = strlen($string) - 1;
		return $string[random_int(0, $max)];
	}
}