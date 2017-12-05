<?php $style = '';
$style .= $block->width ? 'width: '.$block->width.'px;' : '';
$style .= $block->height ? 'height: '.$block->height.'px;' : '';
?>

<div <?=$style != '' ? 'style="'.$style.'"' : '';?>>
	<div class="front">
		<div><?=$block->text_front;?></div>
		<img src="<?=$block->getImageUrl($block->image_front, $block->width.'x'.$block->height);?>" alt="<?=$block->capture_front;?>">
		<div><?=$block->capture_front;?></div>
	</div>

	<div class="back">
		<div><?=$block->text_back;?></div>
		<img src="<?=$block->getImageUrl($block->image_back, $block->width.'x'.$block->height);?>" alt="<?=$block->capture_back;?>">
		<div><?=$block->capture_back;?></div>
	</div>

	<div><?=$block->control_text;?></div>
</div>