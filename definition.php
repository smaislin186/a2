<?php
require ('tools.php');
// https://github.com/adambom/dictionary.git
$dictJson = file_get_contents('dictionary.json');
$dictionary = json_decode($dictJson, true);

if(isset($_GET['word'])){
    $word = (isset($_GET['word'])) ? $_GET['word']: "";
    
    // validation to check for non-alphabetic characters
    if(!ctype_alpha($word)){
        $definition = 'Not a word';
        return $definition;
    }  
    $wordUp = strtoupper($word);
    $definition = $dictionary[$wordUp];
}
    //header('Location: /');