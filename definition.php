<?php

// https://github.com/adambom/dictionary.git
$dictJson = file_get_contents('dictionary.json');

$dictionary = json_decode($dictJson, true);

if(isset($_GET['word'])){
    $word = (isset($_GET['word'])) ? $_GET['word']: "";
    $wordUp = strtoupper($word);
    $bonus = (isset($_GET['bonus'])) ? $_GET['bonus']: "";
    $bonusWord;
    $bonusLetter;
    $wordUp = strtoupper($word);
    $valid = $dictionary[$wordUp];
    

    
    return $valid;

}
    header('Location: /');