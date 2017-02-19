<?php 
require('layout.php');
 ?>
<!doctype html>
<html>
<body>
    <h2>Scrabble Word Calculator</h2>
    <form method ='GET' action='/'>
        <label for='word'>Enter Word:</label>
        <input type='text' name='word' id ='word' value='<?=sanitize($word)?>'>
        <input type='submit' value='Lookup' class='btn-primary btn small'>
        <input type='submit' value='Score Word' class='btn-primary btn small' formaction='calculate.php'>
    </form>
    <div class='definition'>
        <?php if($definition): ?>
            <div class='alert alert-info'><?=sanitize($definition)?></div>
        <?php else: ?>
             <div class='alert alert-warning'><?=sanitize($definition)?></div>
        <?php endif; ?>
    </div>
</body>
</html>