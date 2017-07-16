# PasswordMaker

**Disclaimer:** I would not use this tool on a server that's not under your control. In my own usecase, sometimes I just need to create a password quickly, figured visiting a webpage (hosted on my computer) would be better than "randomly" mashing keys on the keyboard.
That said there are 3 methods available:

###Simple
Randomly picks characters from the alphabet I provided it. All that's needed to use this is to tell it the length of the password you want to generate.

    require 'PasswordMakerSimple.php';
    $password  = new Lucasjkr\PasswordMaker\Simple();
    echo $password->generate(8);

**Example output:** `CD$\[daJ`
    
###Custom
Same logic as Simple, except you choose how many uppercase, lowercase, numbers and symbols there are. Example:

    require 'PasswordMakerCustom.php';
    $password  = new Lucasjkr\PasswordMaker\Custom();
    $password->uppers  = 4;
    $password->lowers  = 4;
    $password->numbers = 1;
    $password->symbols = 1;
    
    echo $password->generate();

**Example output:** `K~tPv2WPzm`

##Words
This is basically a [Correct Horse Battery Stapler](https://www.xkcd.com/936/) generator of your own. Feed it a source of words, tell it how many random words to choose, and there's a password for you.

    require 'PasswordMakerWords.php';
    $password  = new Lucasjkr\PasswordMaker\Words();
    $password->dictionary = "dictionary.txt";
    echo $password->generate(4);
    
**Example output:** `groove blare gob treadmill`
