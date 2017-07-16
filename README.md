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


###Words/Leetify
Additionally, you can specify "Leet Speak" transformations to be made on the output, and choose the frequency that those subsitutions will occur:

    require 'src/PasswordMakerWords.php';
    $password  = new Lucasjkr\PasswordMaker\Words();
    $password->dictionary = "dictionary.txt";
    $password->leetify    = true;
    $password->chance     = 10;
    echo $password->generate(4);

**Example output:** `gro0ve blare gob treadm!ll

I would caution against setting the chance too high - part of the appeal of using a series of words as a password is that its easily memorizable, yet potentially harder to brute force. If you set it too high, it could be harder to memorize, and could become more predicable (as the point is to introduce uncertainty - if an attacker knows that every instance of `e` will be replaced by `3`, you've done nothing but make your password harder to memorize)`

Setting `chance` to 100 will transform output like `compiled braket between dime` into `c0mp!13d 8r4ck37 837w33n d!m3`