<?php 
require('layout.php');
require('definition.php');
require('scrabble.php');
?>
<!doctype html>
<html>
<body>
    <h2>Scrabble Word Calculator</h2>
    <form method ='POST' action='resultView.php'>
        <?php echo $definition ?>
           <fieldset class='radios'>  
            <legend>Letter Bonus</legend>
            <?php foreach($wordArray as $key => $letter): ?>
                <div class ='letters'>
                    <?=$letter?>
                    <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] value='N'>None</label>
                    <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] value='D'>Double</label>
                    <label class="radio-inline"><input type='radio' name=bonusLetterGroup[<?php print $key; ?>][<?php print $letter; ?>] value='T'>Triple</label>
            <?php endforeach; ?>           
        </fieldset>

        <label for='bonusWord'>Select a word bonus</label>
		<select name='bonusWord' id='bonusWord'>
            <option value='choose'>Choose one...</option>
            <option value='none' <?php if($bonusWord == 'none') echo 'SELECTED'?>>None</option>
            <option value='double' <?php if($bonusWord == 'double') echo 'SELECTED'?>>Double Word</option>
            <option value='triple' <?php if($bonusWord == 'triple') echo 'SELECTED'?>>Triple Word</option>
        </select>

        <input type='checkbox' name='bingo' id ='bingo' <?php if($letterCount < 7) echo 'disabled'?> <?php if($bingo) echo 'CHECKED'?>>
        <label>Bingo?:</label>    
        
        <input type='submit' value='Calculate' class='btn-primary btn small'>
    
    </form>
</body>
</html>