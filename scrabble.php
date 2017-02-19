<?php 

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

$word ='';

if(isset($_GET['word'])){
    $word = (isset($_GET['word'])) ? $_GET['word']: "";
    $wordUp = strtoupper($word);
    $wordArray = str_split($wordUp, 1);
    $valid = $dictionary[$wordUp];
}

if(isset($_POST['submit'])){
    foreach($wordArray as $key => $letter){

        $radio[] = isset($_POST['radio']);
        dump($radio);
        $score = 0;
        foreach($wordArray as $key => $userLetter){               
            $score += $letterValue[$userLetter];
        }
        // add bonus to score
        if($bonus){
            $score += 50;
        }
            return $wordArray;
        }
    }
        





