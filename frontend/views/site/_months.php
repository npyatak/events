<?php
use common\helpers\StringHelper;

use common\models\Event;

$sizes = [
	1 => [250, 290],
	2 => [540, 290],
	3 => [540, 620],
];
?>

<div class="month-items">
	<?php foreach (Event::getMonthsArray() as $monthNumber => $m):?>
	<div class="month-title">
		<h2><?=StringHelper::ucfirst($m[0]);?></h2>
		<div class="share-inline">
			<span class="share-inline_btn"><i class="ion-android-share"></i></span>
			<a href="" class="btn-share btn-facebook"><i class="fa fa-facebook"></i></a>
			<a href="" class="btn-share btn-twitter"><i class="fa fa-twitter"></i></a>
			<a href="" class="btn-share btn-odnoklassniki"><i class="fa fa-odnoklassniki"></i></a>
			<a href="" class="btn-share btn-vk"><i class="fa fa-vk"></i></a>
			<a href="" class="btn-share btn-telegram"><i class="fa fa-telegram"></i></a>
		</div>
	</div>
	<div class="masonry-items">
		<?php if(isset($events[$monthNumber])):?>
			<?php foreach ($events[$monthNumber] as $event):?>
				<?php $size = $sizes[$event->size];?>
				<?php $classes = [];
				foreach ($event->categories as $cat) {
					$classes[] = 'cat_'.$cat->alias;
				}
				if($category && !in_array($category, $classes)) {
					$classes[] = 'incative';
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
			<?php endforeach;?>
		<?php endif;?>
	</div>
	<?php endforeach;?>
</div>