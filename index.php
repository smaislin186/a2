<?php 
require('layout.php');
require('scoreLogic.php');
 ?>
    <div class="container-fluid">   
        <h2>Scrabble Word Finder & Calculator</h2>
        
        <form method ='GET' action='/'>
            <label for='word'>Enter a Word (required)</label>
            <input type='text' name='word' id ='word' required value='<?=$form->prefill('word')?>'>
            <input type='submit' value='Lookup' class='btn-primary btn small'>
        </form>

        <?php if($errors):?>
        <div class='alert alert-danger'>
            <?php foreach($errors as $error): ?>
                <?=$error?><br>
            <?php endforeach; ?>
        </div>
        <?php elseif($form->isSubmitted()):?>
            <div class='definition'>
                <div class='alert alert-info'>Definition: <?=sanitize($definition) ?></div>
            </div>
            <form method ='POST' action='score.php'>
                <div class ='LetterBonus'>
                <fieldset class='radios'>  
                    <legend>Letter Bonus</legend>
                    <?php foreach($wordArray as $key => $letter): ?>
                        <div class ='letter-group'>
                            <div class='letter'><?=$letter?></div>
                            <div class='radioGroup'>
                                <div class="radio-inline">
                                    <input type='radio' id='radioN' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] 
                                        value='N' checked='CHECKED'>
                                    <label for='radioN'>None</label>
                                </div>
                                <div class="radio-inline">
                                    <input type='radio' id='radioD' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] 
                                        value='D'>
                                    <label for='radioD'>Double</label>
                                </div>
                                <div class="radio-inline">
                                    <input type='radio' id='radioT' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] 
                                        value='T'>
                                    <label for='radioT'>None</label>
                                </div>
                            </div>    
                    <?php endforeach; ?>           
                    </fieldset>
                </div>
                <div class='WordBonus'>
                    <legend>Word Bonus</legend>
                    <select name='bonusWord' id='bonusWord'>
                        <option value='none' <?php if($formP->get('bonusWord')=='none') echo 'SELECTED'?>>None</option>
                        <option value='double' <?php if($formP->get('bonusWord')=='double') echo 'SELECTED'?>>Double Word</option>
                        <option value='triple' <?php if($formP->get('bonusWord')=='triple') echo 'SELECTED'?>>Triple Word</option>
                    </select>
                </div>
                <div class = "BingoBonus">
                    <legend>Bingo Bonus</legend>
                    <input type='checkbox' name='bingo' id ='bingo' <?php if(!$bingoEligible) echo 'disabled'?> 
                        <?php if($formP->isChosen('bingo')) echo 'CHECKED'?>>
                    <label>Played all seven tiles in your hand?</label>    
                </div>
                <div class='Calculate'>
                    <input type='submit' value='Score' class='btn-primary btn small'>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>