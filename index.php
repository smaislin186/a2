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
            <label for='word'>Enter Word:</label>
            <input type='text' name='word' id ='word' required 
                value='<?php if($form->get('word')): ?>
                            <?php echo $_GET['word'] ?>
                       <?php elseif($formP->get('word')): ?>     
                            <?php echo $_GET['word'] ?>
                       <?php endif;?>'>
            <input type='submit' value='Lookup' class='btn-primary btn small'>
        </form>

        <?php if($errors):?>
        <div class='alert alert-danger'>
            <?php foreach($errors as $error): ?>
                <?=$error?><br>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <div class='definition'>
                <?php if($form->get('word')): ?>
                    <div class='alert alert-info'><?=sanitize($definition) ?></div>
                <?php endif; ?>
            </div>
            
            <?php if($form->isSubmitted()):?>
                <form method ='POST' action='/?word'>
                        <?php echo $word ?>
                        <!--<?php echo $definition ?>-->
                        <div class ='LetterBonus'>
                        <fieldset class='radios'>  
                            <legend>Letter Bonus</legend>
                            <?php foreach($wordArray as $key => $letter): ?>
                                <div class ='letter-group'>
                                    <div class='letter'><?=$letter?></div>
                                    <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] value='N' checked="checked">None</label>
                                    <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] value='D'>Double</label>
                                    <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] value='T'>Triple</label>
                            <?php endforeach; ?>           
                            </fieldset>
                        </div>
                        <div class='WordBonus'>
                            <legend>Word Bonus</legend>
                            <select name='bonusWord' id='bonusWord'>
                                <option value='choose'>Choose one...</option>
                                <option value='none' <?php if($bonusWord == 'none') echo 'SELECTED'?>>None</option>
                                <option value='double' <?php if($bonusWord == 'double') echo 'SELECTED'?>>Double Word</option>
                                <option value='triple' <?php if($bonusWord == 'triple') echo 'SELECTED'?>>Triple Word</option>
                            </select>
                        </div>
                        <div class = "BingoBonus">
                            <legend>Bingo Bonus</legend>
                            <input type='checkbox' name='bingo' id ='bingo' <?php if($letterCount < 7) echo 'disabled'?> <?php if($bingo) echo 'CHECKED'?>>
                            <label>Did you use all seven tiles in your hand?</label>    
                        </div>
                        <div class='Calculate'>
                            <input type='submit' value='Score' class='btn-primary btn small'>
                        </div>
                    </form>
                    <div class='score'>
                        <?php if($score != NULL): ?>
                             <div class='alert alert-info'>Calculated Score = <?=sanitize($score) ?>
                        <?php endif; ?>
                    </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>