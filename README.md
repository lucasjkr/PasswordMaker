# PasswordMaker

**Disclaimer:** I would not use this tool on a server that's not under your control. In my own usecase, sometimes I just need to create a password quickly, figured visiting a webpage (hosted on my computer) would be better than "randomly" mashing keys on the keyboard.
That said there are 3 methods available, Simple, Custom and Phrase, which will be explained below.

No matter which method you choose, care should be taken to validated the values passed into the functions (in the page controller, or whereever else you use validation). For instance, with any of the methods it's possible to set an output of any length - i would rather leave it up to you to decide the proper setting than hardcode it.

To include this in your project, either:

* Download from Github
* Pull the package into your project with `composer require lucasjkr/password-maker dev-master`

###Simple
Randomly picks characters from the alphabet I provided it. All that's needed to use this is to tell it the length of the password you want to generate.

    use Lucasjkr\PasswordMaker\Simple as Simple;

    $password = new Simple();

    echo $password->generate(8);

**Example output:** `CD$\[daJ`
    
###Custom
Same logic as Simple, except you choose how many uppercase, lowercase, numbers and symbols there are. Example:

    use Lucasjkr\PasswordMaker\Custom as Custom;
    $password = new Custom();

    $password->uppers  = 4;
    $password->lowers  = 4;
    $password->numbers = 1;
    $password->symbols = 1;
    
    echo $password->generate();

**Example output:** `K~tPv2WPzm`

##Phrase
This is basically a [Correct Horse Battery Stapler](https://www.xkcd.com/936/) generator of your own. Feed it a source of words, tell it how many random words to choose, and there's a password for you.
    
    use Lucasjkr\PasswordMaker\Phrase as Phrase;

    $dictionary = '..path to your dictionary file ..';
    $password = new Phrase($dictionary);
    echo $password->generate(4);
    
**Example output:** `groove blare gob treadmill`


###Phrase/Capitalize
Capitalizes the first letter of each word to improve readabilty.

    use Lucasjkr\PasswordMaker\Words as Words;

    $dictionary = '..path to your dictionary file ..';
    $password = new Words($dictionary);
    $password->capitalize = true;

    echo $password->generate(4);
    
**Example output:** `Groove Blare Gob Treadmill`

###Phrase/Leetify
Additionally, you can specify "Leet Speak" transformations to be made on the output, and choose the frequency that those subsitutions will occur. This can be combined with the capitalize transformation:

    use Lucasjkr\PasswordMaker\Words as Words;

    $dictionary = '..path to your dictionary file ..';
    $password = new Words($dictionary);

    $password->capitalize = true;
    $password->leetify    = true;
    $password->chance     = 10;

    echo $password->generate(4);

**Example output:** `Gro0ve Blare Gob Treadm!ll

I would caution against setting the chance too high - part of the appeal of using a series of words as a password is that its easily memorizable, yet potentially harder to brute force. If you set it too high, it could be harder to memorize, and could become more predicable (as the point is to introduce uncertainty - if an attacker knows that every instance of `e` will be replaced by `3`, you've done nothing but make your password harder to memorize)`

Setting `chance` to 100 will transform output like `compiled braket between dime` into `c0mp!13d 8r4ck37 837w33n d!m3`