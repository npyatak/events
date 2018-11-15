<div class="turn-block">
    <div class="row justify-content-end m-0">
        <div class="turn-block_inner" style="width: <?=$block->width;?>px; height: <?=$block->height;?>px">
            <div class="hover panel" style="width: <?=$block->width;?>px; height: <?=$block->height;?>px">
                <div class="front">
                    <div class="box1" style="width: <?=$block->width;?>px; height: <?=$block->height;?>px;<?php if($block->image_front):?> background-image: url(<?=$block->getImageUrl($block->image_front, $block->width.'x'.$block->height);?>)<?php endif;?>">
                        <?php if($block->text_front):?><div class="bg"></div><?php endif;?>
                        <div class="question">
                            <?=$block->text_front;?>
                        </div>
                        <div class="caption">
                            <?=$block->capture_front;?>
                        </div>
                        <div class="bottom turn-btn">
                            <?=$block->control_text;?>
                            <div class="turn"></div>
                        </div>
                    </div>
                </div>
                <div class="back">
                    <div class="box2" style="width: <?=$block->width;?>px; height: <?=$block->height;?>px;<?php if($block->image_back):?> background-image: url(<?=$block->getImageUrl($block->image_back, $block->width.'x'.$block->height);?>)<?php endif;?>">
                        <?php if($block->text_back):?><div class="bg"></div><?php endif;?>
                        <div class="answer">
                            <?=$block->text_back;?>
                        </div>
                        <div class="caption">
                            <?=$block->capture_back;?>
                        </div>
                        <div class="bottom turn-btn">
                            <?=$block->control_text_back;?>
                            <div class="turn"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>