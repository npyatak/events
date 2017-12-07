<?php $style = '';
$style .= $block->width ? 'width: '.$block->width.'px;' : '';
$style .= $block->height ? 'height: '.$block->height.'px;' : '';
?>

<div class="turn-block" <?=$style != '' ? 'style="'.$style.'"' : '';?>>
    <div class="row justify-content-end m-0">
        <div class="turn-block_inner m-r-40">
            <div class="hover panel">
                <div class="front">
                    <div class="box1" <?php if($block->image_front):?> style="background-image: url(<?=$block->getImageUrl($block->image_front, $block->width.'x'.$block->height);?>)" <?php endif;?>>
                        <div class="question"><?=$block->text_front;?></div>
                        <div class="caption">
                            <?=$block->capture_front;?>
                        </div>
                        <div class="bottom"><?=$block->control_text;?></div>
                    </div>
                </div>
                <div class="back">
                    <div class="box2" <?php if($block->image_back):?> style="background-image: url(<?=$block->getImageUrl($block->image_back, $block->width.'x'.$block->height);?>)" <?php endif;?>>
                        <div class="answer"><?=$block->text_back;?></div>
                    </div>
                </div>
            </div>
            <div class="turn"></div>
        </div>
    </div>
</div>