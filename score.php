<?php
require('Form.php');
use DWA\Form;

//initialize the session
if (!isset($_SESSION)) {
    session_start();
}
// if (ini_get('register_globals'))
// {
//     foreach ($_SESSION as $key=>$value)
//     {
//         if (isset($GLOBALS[$key]))
//             unset($GLOBALS[$key]);
//     }
// }

$_SESSION['word']='';
$_SESSION['wordArray']=[];
$_SESSION['letterCount']='';
$_SESSION['bingo']='';
$form = new Form($_GET);
$formP = new Form($_POST);

//initialize variables so can display default values on page
$errors = false;
$score = 0;
$bingo = false;
$bonusLetter='';

if($form->isSubmittedGet()){
    
    if($form->isSubmitted())
    {
        // Validate if have non-numeric required word
        $errors = $form->validate(
            [
                'word' => 'required|alpha'
            ]
        );

        // load dictionary - if time, refactor to own Class
        $dictJson = file_get_contents('static/dictionary.json');
        $dictionary = json_decode($dictJson, true);
        
        // Validate if input word exists in dictionary
        $word = $form->get('word','');
        if($word != ''){
            $wordUp = strtoupper($word);
            
            // search dictionary
            if($dictionary[$wordUp] != NULL){
                $definition = $dictionary[$wordUp];
                // dump($definition);
                $wordArray = str_split($wordUp, 1);
                $_SESSION['wordArray']=$wordArray;
                $_SESSION['word']=$wordUp;
                dump($_SESSION['word']);
                // used to check validity of Bingo Bonus (must have at least 7 letters)
                $letterCount = count($wordArray);    
                $_SESSION['letterCount']=$letterCount;
            }
            else{
                array_push($errors, 'Word not found');
                return $errors;
            }
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
    $_SESSION['bonusLetter'] = $bonusLetter;
    dump($bonusLetter);
    dump($_SESSION['wordArray']);
    $bonusWord = $formP->get('bonusWord', '');
    $_SESSION['bonusWord'] = $bonusWord;
dump($_SESSION['word']);
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