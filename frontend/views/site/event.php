<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $event->title;

$url = Url::canonical();
$title = $event->socials_title ? $event->socials_title : $this->title;
$desc = $event->socials_text;
$image = $event->socials_image_url;

$this->registerMetaTag(['property' => 'og:description', 'content' => $desc], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
$this->registerMetaTag(['property' => 'fb:app_id', 'content' => '1704949819546160'], 'fb:app_id');/*TODO узнать id*/
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
	<?php if($eventBlock->block->formName() == 'BlockFact') {
		print_r($eventBlock->block->blockFactItems);
	}?>
<?php endforeach;?>