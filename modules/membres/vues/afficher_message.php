<div class="messageTitle">
	<span class="author">
		<?php echo 'Auteur:&nbsp'?>
	 </span>
	 <?php echo $mainMessage["messageRecord"]["nom_utilisateur"]?>
	<span class="time">
		<?php echo $mainMessage['messageRecord']['horoDate']?>
	</span>
</div>
<div class="rootMessage">
		<?php echo $mainMessage['messageRecord']['texte'] ?>
	<br/>
	<?php echo $repondreButton ?>

