<?php
use yii\helpers\Url;

$sizes = [
	1 => [250, 290],
	2 => [540, 290],
	3 => [540, 620],
];
$size = $sizes[$event->size];

$classes = [];
$color = null;
foreach ($event->categories as $cat) {
	if(!$color) {
		$color = $cat->color;
	}
	$classes[] = 'cat_'.$cat->alias;
}
if($category && !in_array('cat_'.$category, $classes)) {
	$classes[] = 'inactive';
}
?>

<div class="grid-item w<?=$size[0];?>-h<?=$size[1];?> <?=implode(' ', $classes);?>">
	<?php 
	if($this->params['is_mobile']) {
		$imageUrl = $event->getImageUrl($event->mobile_image_url);
	} else {
		$imageUrl = $event->getImageUrl($event->main_page_image_url, $size[0].'x'.$size[1]);
	}?>

	<div class="grid-item_image" style="background-image:url('<?=$imageUrl;?>')">
		<a href="<?=$event->url;?>" style="background-color:<?=$color ? $color : '';?>"></a>
	</div>
	<div class="grid-item_desc">
		<h2 style="color:<?=$color ? $color : '';?>"><a href="<?=$event->url;?>"><?=$event->title;?></a></h2>
		<span class="date"><?=$event->viewDate[0];?> <?=$event->viewDate[1];?></span>
		<a href="<?=$event->url;?>" class="link-arrow">
			<i class="fa fa-angle-right"></i>
			<span class="hover" style="background-color:<?=$color ? $color : '';?>"></span>
			<span class="default"></span>
		</a>
	</div>
</div>