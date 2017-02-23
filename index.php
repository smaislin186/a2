<?php 
require('layout.php');
require('definition.php');

//require('scrabble.php');
 ?>
<!doctype html>
<html>
<body>
    <div class="container-fluid">   
        <h2>Scrabble Word Finder & Calculator</h2>
        
        <form method ='GET' action='/'>
            <label for='word'>Enter a Word:</label>
            <input type='text' name='word' id ='word' required 
                value='<?=$_SESSION['word']?>'>
            <input type='submit' value='Lookup' class='btn-primary btn small'>
        </form>
        <?php if($errors):?>
        <div class='alert alert-danger'>
            <?php foreach($errors as $error): ?>
                <?=$error?><br>
            <?php endforeach; ?>
        </div>
        <?php elseif($form->isSubmitted() ):?>
            <div class='definition'>
                <?php if($form->get('word')): ?>
                    <div class='alert alert-info'><?=sanitize($definition) ?></div>
                <?php endif; ?>
            </div>
            <form method ='POST' action='/'>
                <h3>Select bonus squares for <?php echo sanitize($_SESSION['word']) ?></h3>
                <div class ='LetterBonus'>
                <fieldset class='radios'>  
                    <legend>Letter Bonus</legend>
                    <?php foreach($_SESSION['wordArray'] as $key => $letter): ?>
                        <div class ='letter-group'>
                            <div class='letter'><?=$letter?></div>
                            <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] 
                                value='N' <?php if($bonusLetter=='N') echo 'CHECKED'?>>None</label>
                            <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] 
                                value='D' <?php if($bonusLetter=='D') echo 'CHECKED'?>>Double</label>
                            <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] 
                                value='T' <?php if($bonusLetter=='T') echo 'CHECKED'?>>Triple</label>
                    <?php endforeach; ?>           
                    </fieldset>
                </div>
                <div class='WordBonus'>
                    <legend>Word Bonus</legend>
                    <select name='bonusWord' id='bonusWord'>
                        <option value='choose'>Choose one...</option>
                        <option value='none' <?php if($formP->get('bonusWord')=='none') echo 'SELECTED'?>>None</option>
                        <option value='double' <?php if($formP->get('bonusWord')=='double') echo 'SELECTED'?>>Double Word</option>
                        <option value='triple' <?php if($formP->get('bonusWord')=='triple') echo 'SELECTED'?>>Triple Word</option>
                    </select>
                </div>
                <div class = "BingoBonus">
                    <legend>Bingo Bonus</legend>
                    <input type='checkbox' name='bingo' id ='bingo' <?php if($_SESSION['letterCount'] < 7) echo 'disabled'?> 
                        <?php if($formP->isChosen('bingo')) echo 'CHECKED'?>>
                    <label>Played all seven tiles in your hand?</label>    
                </div>
                <div class='Calculate'>
                    <input type='submit' value='Score' class='btn-primary btn small'>
                </div>
            </form>
        <?php endif; ?>
        <?php if($formP->isSubmitted()):?>
            <div class='score'>
                <?php if($score != NULL): ?>
                    <div class='alert alert-success'>Calculated Score = <?=sanitize($score) ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>