<?php

// https://github.com/adambom/dictionary.git
$dictJson = file_get_contents('static/dictionary.json');
$dictionary = json_decode($dictJson, true);
global $word;
global $wordArray;

if(isset($_GET['word'])){
    $word = (isset($_GET['word'])) ? $_GET['word']: "";
    
    // validation to check for non-alphabetic characters
    if(!ctype_alpha($word)){
        $definition = 'Not a word';
        return $definition;
    }  
    $wordUp = strtoupper($word);
    $definition = $dictionary[$wordUp];
    $wordArray = str_split($wordUp, 1);
}
    //header('Location: /');