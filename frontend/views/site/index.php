<?php if($events):?>
	<?php foreach ($events as $event):?>
		<?=$event->title;?>
		<br>
		<hr>
	<?php endforeach;?>
<?php endif;?>