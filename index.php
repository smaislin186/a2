<?php require('scrabble.php'); ?>
<!doctype html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">    
    <link rel="stylesheet" href="static/styles.css"
    <title>Foobooks</title>
	<meta charset='utf-8'>
</head>
<body>
    <h2>Scrabble Word Calculator</h2>
    <form method ='GET' action='/'>
        <label for='word'>Enter Word:</label>
        <input type='text' name='word' id ='word' value='<?=sanitize($word)?>'>
        <input type='submit' value='Validate' class='btn-primary btn small' formaction='definition.php'>
        <?php echo $valid ?>
     <fieldset class='radios'>
        <legend>Letter Bonus</legend>
        <?php foreach($wordArray as $key => $letter): ?>
            <div class ='letters'>
                <!--<input type='checkbox' name='letter' id='letter'>-->
                <?=$letter?>
                    <label><input type='radio' name='none' value='none' <?php if($letterBonus == 'none') echo 'CHECKED'?>> None</label>
                    <label><input type='radio' name='double' value='double' <?php if($letterBonus == 'double') echo 'CHECKED'?>> Double</label>
                    <label><input type='radio' name='triple' value='triple' <?php if($letterBonus == 'triple') echo 'CHECKED'?>> Triple</label>
                </fieldset>
        <?php endforeach; ?>
        <input type='checkbox' name='bonus' id ='bonus' <?php if($bonus) echo 'CHECKED'?>>
        <label>Bingo?:</label>
    </form>

</body>
</html>