<?php
namespace Lucasjkr\PasswordMaker;

class Simple {

    public function generate($length = 1) {
        $password = '';
        for ($i = 1; $i <= $length; $i++) {
            $password .= $this->randomCharacter();
        }
        return $password;
    }

    private function randomCharacter(){
        // none of the following characters:
        // '  "  i  I  l  L  o  O  1  0  <  >  &
        $chars  = 'abcdefghjkmnpqrstuvwxyz';
        $chars .= 'ABCDEFGHJKMNPQRSTUVWXYZ';
        $chars .= '23456789';
        $chars .= '!@#$%^*-_=+|,.?()|\/[]{}';

        $length = strlen($chars) - 1;

        return htmlspecialchars($chars[random_int(0, $length)]);
    }

}