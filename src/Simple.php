<?php
namespace Lucasjkr\PasswordMaker;

class Simple {

    /********************************************************************************/
    /*  PasswordMaker Version 1.1                                                   */
    /********************************************************************************/

    private $character;

    public function __construct()
    {
        // none of the following characters:
        // '  "  i  I  l  L  o  O  1  0  <  >  & | % \
        $this->character  = 'abcdefghjkmnpqrstuvwxyz';
        $this->character .= 'ABCDEFGHJKMNPQRSTUVWXYZ';
        $this->character .= '23456789';
        $this->character .= '!@#$^*-_=+,.?()/[]{}';
    }

    public function generate($length = 1)
    {
        $password = '';
        for ($i = 1; $i <= $length; $i++)
        {
            $password .= $this->randomCharacter();
        }
        return $password;
    }

    private function randomCharacter()
    {
        $length = strlen($this->character) - 1;

        return $this->character[random_int(0, $length)];
    }

}