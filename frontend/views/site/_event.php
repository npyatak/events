<?php
use yii\helpers\Url;

$sizes = [
	1 => [250, 290],
	2 => [540, 290],
	3 => [540, 620],
];
$size = $sizes[$event->size];

$classes = [];
foreach ($event->categories as $cat) {
	$classes[] = 'cat_'.$cat->alias;
}
if($category && !in_array($category, $classes)) {
	$classes[] = 'inactive';
}
?>

<div class="grid-item w<?=$size[0];?>-h<?=$size[1];?> <?=implode(' ', $classes);?>">
	<div class="grid-item_image">
		<a href="<?=$event->url;?>" style="background-image:url('<?=$event->getImageUrl($event->main_page_image_url, $size[0].'x'.$size[1]);?>')"></a>
	</div>
	<div class="grid-item_desc">
		<h2><a href="<?=$event->url;?>"><?=$event->title;?></a></h2>
		<span class="date"><?=$event->viewDate[0];?> <?=$event->viewDate[1];?></span>
		<a href="" class="link-arrow"><i class="fa fa-angle-right"></i></a>
	</div>
</div>