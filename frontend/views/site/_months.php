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
	<div class="month-title"><h2><?=StringHelper::ucfirst($m[0]);?></h2></div>
	<div class="share-inline">
		<span class="share-inline_btn"><i class="fa fa-share-alt"></i></span>
	</div>
	<div class="masonry-items">
		<?php if(isset($events[$monthNumber])):?>
			<?php foreach ($events[$monthNumber] as $event):?>
				<?php $size = $sizes[$event->size];?>
				<div class="grid-item w<?=$size[0];?>-h<?=$size[1];?>">
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