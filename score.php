<?php 
require('layout.php');
require('scoreLogic.php');
 ?>
    <div class="container-fluid">   
        <h2>Scrabble Word Finder & Calculator</h2>
        <?php if($formP->isSubmitted()):?>
            <div class='score'>
                <?php if($score != NULL): ?>
                    <div class='alert alert-success'>Your word score is <?=sanitize($score) ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
	<footer>
		<a href='/'>&larr; Score a new Word</a>
	</footer>
    </div>
</body>
</html>