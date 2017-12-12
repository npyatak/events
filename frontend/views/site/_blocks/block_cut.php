<div class="why-block">
    <div class="why-block_inner">
        <h3><?=$block->title;?></h3>
        <div class="change-block">
            <div class="">
                <p><?=$block->preview;?></p>
            </div>
            <div class="hidden">
                <?=$block->text;?>
            </div>
            <div class="more" data-text-show="<?=$block->text_show ? $block->text_show : 'Показать';?>"  data-text-hide="<?=$block->text_show ? $block->text_hide : 'Свернуть';?>">
                <span class="more-btn show tt-up">
                    <span class="more-text"><?=$block->text_show;?></span><i class="fa fa-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</div>


<?php 
$script = "
    $(document).ready(function () {
        var elems;
        if($('.block_cut_end').length) {
            elems = $('.block_cut').nextUntil('.block_cut_end', '.block');
        } else {
            elems = $('.block_cut').nextAll('.block');
        }
        elems.hide();

        $(document)
            .on('click','.block_cut .show',function () {
                $(this).parent().parent().find('.hidden').slideDown(500);
                $(this).toggleClass('show hide rotate');
                $(this).find('.more-text').text($(this).parent().data('text-hide'));
                elems.show();
            })
            .on('click','.block_cut .hide',function () {
                $(this).parent().parent().find('.hidden').slideUp(500);
                $(this).toggleClass('show hide rotate');
                $(this).find('.more-text').text($(this).parent().data('text-show'));
                elems.hide();
            });
    });
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>