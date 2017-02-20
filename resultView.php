<?php 
require('layout.php');
 ?>
<html>
<body>
    <h2>Scrabble Word Calculator</h2>

    <div class='score'>
        <?php if($score != NULL){ ?>
            Score: <?php echo $score; ?>
        <?php } else { ?> 
            <?php echo $message; ?>
        <?php } ?>
    </div>
</body>
</html>