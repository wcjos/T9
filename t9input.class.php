<?php

include_once("trie.class.php");
class T9input
{
    public $trie;
    const DICTIONARY_FILE = "dictionary.txt";
    public $key = array(
        '2'   => 'abcABCD',
        '3'   => 'defDEF',
        '4'   => 'ghiGHI',
        '5'   => 'jklJKL',
        '6'   => 'mnoMNO',
        '7'   => 'pqrsPQRS',
        '8'   => 'tuvTUV',
        '9'   => 'wxyzWXYZ'
    );

    public function __construct()
    {
        ini_set('memory_limit', '512M');
        $this->trie = new Trie();
    }

    /**
     * @param string $file  Dictionary file, should contain word by word in each line
     * @param array $prefix To reduce usage memory, we should add only words have same prefix
     *                      with input into Trie tree's dictionary
     */
    public function addDB($DB, $prefix = array())
    {
        //$dictionary = file_get_contents($DB);

        $words = explode("|", $DB);
        foreach ($words as $word) 
        {
            if ($word != '') 
            {
                if (in_array($word[0], $prefix)) 
                {
                    $this->trie->add($word);
                }
            }
        }
        unset($words);
    }

    /**
     * Generate all strings from $input
     * Ex: 23 => [ad, ae, af, bd, be, bf, cd, ce, cf]
     * @param string $input
     * @return array
     */
    public function getAllPatternsFromInput($input)
    {
        $patterns = array();
        $numbers = str_split($input);
        $validNumbers = array_keys($this->key);
        foreach ($numbers as $number) {
            if (in_array($number, $validNumbers)) {
                $reversedChars = str_split($this->key[$number]);
                $patterns = $this->appendChars($patterns, $reversedChars);
            }
        }
        return $patterns;
    }

    private function appendChars($patterns, $chars = array())
    {
        $newPatterns = array();
        if (count($patterns) == 0) {
            return $chars;
        }
        foreach ($patterns as $pattern) {
            foreach ($chars as $char) {
                $newPatterns[] = $pattern . $char;
            }
        }
        return $newPatterns;
    }

    /**
     * @param $input - number 0-9, pressed by user
     * @return array - list of possible words
     */
    public function translate($input)
    {
        $searchWords = $this->getAllPatternsFromInput($input);
        $result = array();
        foreach ($searchWords as $word) {
            $tmp = $this->trie->prefixSearch($word);
            if (is_array($tmp)) {
                $result = array_merge($result, array_keys($tmp));
            }
        }
        return array_unique($result);
    }
}
