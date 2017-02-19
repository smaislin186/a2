<?php 
require('layout.php');
require('definition.php');
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
                        <label><input type='radio' name=bonusLetterGroup[<?php print $key; ?>] value='N'>None</label>
                        <label><input type='radio' name=bonusLetterGroup[<?php print $key; ?>] value='D'>Double</label>
                        <label><input type='radio' name=bonusLetterGroup[<?php print $key; ?>] value='T'>Triple</label>
            <?php endforeach; ?>           
        </fieldset>
        
        <input type='submit' value='Calculate' class='btn-primary btn small'>
    
    </form>
</body>
</html>