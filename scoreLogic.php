<?php
require('Form.php');

use DWA\Form;

$form = new Form($_GET);
$formP = new Form($_POST);

//initialize variable so can display on page load
$errors = false;

if($form->isSubmitted()){

    // Validate if have non-numeric required word
    $errors = $form->validate(
        [
            'word' => 'required|alpha'
        ]
    );

    // load dictionary
    $dictJson = file_get_contents('static/dictionary.json');
    $dictionary = json_decode($dictJson, true);
        
    // Validate if input word exists in dictionary
    $word = $form->get('word','');
    if($word != ''){
        $wordUp = strtoupper($word);
        
        // search dictionary
        if(!empty($dictionary[$wordUp])){
            $definition = $dictionary[$wordUp];
            $wordArray = str_split($wordUp, 1);
            
            //toggles Bingo Bonus control(must have at least 7 letters)
            if(count($wordArray) < 7 ){
                $bingoEligible = false;
            }
            else{
                $bingoEligible = true;
            }
        }
        else{
            array_push($errors, 'Word not found');
        }
    }
}

if($formP->isSubmittedPost()){
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

    $bonusLetter = $formP->get('bonusLetterGroup','');
    $bonusWord = $formP->get('bonusWord', '');
    $score = 0;

    // calculate individual letter tile scores
    foreach($bonusLetter as $inner_array){
        foreach($inner_array as $letter => $value ){
            if($value == "N"){
                $score += $letterValue[$letter];
            }
            elseif($value == "D"){
                $score += ($letterValue[$letter] * 2);
            }
            elseif($value == "T"){
                $score += ($letterValue[$letter] * 3);
            }
            else{
                $errors = "Error: invalid letter bonus supplied";
            }
        }
    }

    // calculate bonus word tiles
    if($bonusWord == "double"){
        $score *= 2;
    }
    elseif($bonusWord == "triple"){
        $score *= 3;
    }

    // calculate bonus for using all 7 tiles
    if($formP->isChosen('bingo')){
        $score += 50;
    }
//dump($score);
}