<?php
use yii\helpers\Html;
?>

<?=$event->title;?>
<?//=$event->image_url;?>
<?=Html::img($event->getImageUrl('200x200', $event->image_url));?>

<?php foreach ($event->eventBlocks as $eventBlock):?>
	<?=$eventBlock->order;?>
	<br>
	<?php print_r($eventBlock->block);?>
	<br>
	<hr>

<?php endforeach;?>