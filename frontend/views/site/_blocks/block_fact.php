<?php 
use common\models\blocks\items\BlockFactItem;
?>

<?php if($block->blockFactItems):?>
<div class="facts-many">
    <div class="fact-many_inner">
        <?php if($block->title):?>
            <div class="title"><?=$block->title;?></div>
        <?php endif;?>
        <?php foreach ($block->blockFactItems as $item):?>
            <?php $style = ''; $class = '';
            if(!$item->border_top) {
                $style .= 'border-top: none; padding-top: 0;';
            }
            if(!$item->border_bottom) {
                $style .= 'border-bottom: none; padding-bottom: 0;';
            } ?>
            <div class="item sm" <?=$style != '' ? 'style="'.$style.'"' : '';?>>
                <div class="row m-0">
                    <div class="number <?=$item->type == BlockFactItem::TYPE_TOP ? 'with-text' : '';?>">
                        <?=$item->number;?>
                    </div>
                    <h4><?=$item->capture;?></h4>
                </div>

                <?php if($item->link && $item->text):?>
                    <div class="row justify-content-end m-0">
                        <div class="text">
                            <div class="hidden">
                                <?=$item->text;?>
                            </div>
                        </div>
                    </div>
                    <div class="more-other">
                        <span class="more-btn-other show" data-text="<?=$item->link;?>">
                            <span class="more-text"><?=$item->link;?></span>
                            <i class="fa fa-chevron-right"></i>
                        </span>
                    </div>
                <?php endif;?>
            </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;?>

<?php 
$script = "
    $(document).ready(function () {
        $(document)
            .on('click','.block_fact .show',function () {
                $(this).parent().parent().find('.hidden').slideDown(500);
                $(this).toggleClass('show hide rotate');
                $(this).find('.more-text').html('Свернуть');
            })
            .on('click','.block_fact .hide',function () {
                $(this).parent().parent().find('.hidden').slideUp(500);
                $(this).toggleClass('show hide rotate');
                $(this).find('.more-text').html($(this).data('text'));
            });
    });
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>