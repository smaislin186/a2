<?php 

$formP = new Form($_POST);

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

//$form = new DWA\Form($_POST);

// if($form->isSubmitted()) {

//     $errors = $form->validate(
//         [
//             'radio' => 'required|radio',
//             'bonusWord' => 'alphaNumeric',
//             'year' => 'numeric',
//             'age' => 'min:16',
//             'score' => 'max:5',
//             'rank' => 'numeric|min:0|max:5',
//         ]
//     );
// }
//dump($_POST);
//dump($_POST['bonusLetterGroup']);
//dump(isset($_POST['bonusLetterGroup']));

$bonusLetter = $formP->get('bonusLetterGroup', '');
$bonusWord = $formP->get('bonusWord', '');

if(!$_POST){
    $bingo = '';
    $score = '';
    $bonusWord = '';
    $bonusValue = '';
    $bonusLetter = '';  
}
//!isset($_POST['bonusLetterGroup'])  OR !isset($_POST['bonusWord'])
elseif($bonusLetter == '' OR $bonusWord == ''){
    return $message = "Don't for get to fill out all fields";
}
else{
    // save input from form. Note:bonusLetterGroup Has to be 2 dimensional array so that duplicate letters are assigned their own radio button value

    //initialize score
    $score = 0;

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








