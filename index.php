<?php 
require('layout.php');
require('definition.php');
 ?>
<!doctype html>
<html>
<body>
    <h2>Scrabble Word Calculator</h2>
    <form method ='GET' action='/'>
        <label for='word'>Enter Word:</label>
        <input type='text' name='word' id ='word' value='<?php if(isset($_GET['word'])) echo $_GET['word'] ?>'>
        <input type='submit' value='Lookup' class='btn-primary btn small'>
        <input type='submit' value='Score Word' class='btn-primary btn small' formaction='calculateView.php'>
    </form>
    <div class='definition'>
        <?php if(isset($_GET['word'])): ?>
            <div class='alert alert-info'><?=sanitize($definition) ?></div>
        <?php endif; ?>
    </div>


</body>
</html>