<?php
require('Form.php');

require('Dictionary.php');
//use DWA\Form;

$form = new Form($_GET);
$formP = new Form($_POST);
//$dictionary = new Dictionary('static/dictionary.json');
$errors = false;

if($form->isSubmitted()){

    // Validate 
    $errors = $form->validate(
        [
            'word' => 'required|alpha'
        ]
    );    
    //dump($errors);

    $dictJson = file_get_contents('static/dictionary.json');
    $dictionary = json_decode($dictJson, true);

    $word = $form->get('word', '');
    //dump($word);
    //(isset($_GET['word'])) ? $_GET['word']: "";
    
    // validation to check for non-alphabetic characters
    if(!ctype_alpha($word)){
        $definition = 'Not a word';
        return $definition;
    }  
    $wordUp = strtoupper($word);
    //$definition = $dictionary->lookup($word);
    $definition = $dictionary[$wordUp];
    $wordArray = str_split($wordUp, 1);

    // used to check validity of Bingo Bonus (must have at least 7 letters)
    $letterCount = count($wordArray);
}
    //header('Location: /');
if($formP->isSubmitted()){
    //header("Location: ". $_SERVER['REQUEST_URI']. 'word');
    $letterValue = [
        'A' => 1,
        'B' => 3,
        'C' => 3,
        'D' => 2,
        'E' => 1,
        'F' => 4,
        'G' => 2,
        'H' => 4,
        'I' => 1,
        'J' => 8,
        'K' => 5,
        'L' => 1,
        'M' => 3,
        'N' => 1,
        'O' => 1,
        'P' => 3,
        'Q' => 10,
        'R' => 1,
        'S' => 1,
        'T' => 1,
        'U' => 1,
        'V' => 4,
        'W' => 4,
        'X' => 8,
        'Y' => 4,
        'Z' => 10
];
    //$get_word = "?word=success"
    //initialize score
    $score = 0;
    $bonusLetter = $formP->get('bonusLetterGroup', '');
    $bonusWord = $formP->get('bonusWord', '');
    foreach($bonusLetter as $inner_array){
        //dump($inner_array);
        foreach($inner_array as $letter => $value ){
            //dump($key);
            //dump($bonusValue);
            if($value == "D"){
                $score += ($letterValue[$letter] * 2);
            }
            elseif($value == "T"){
                $score += ($letterValue[$letter] * 3);
            }
            else{
                $score += $letterValue[$letter];
            }
        }
    }

    if($bonusWord == "double"){
        $score *= 2;
    }
    elseif($bonusWord == "triple"){
        $score *= 3;
    }

    if($formP->isChosen('bingo')){
        $score += 50;
    }
}