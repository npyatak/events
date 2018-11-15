<div class="why-block" id="cut_<?=$block->id;?>">
    <div class="why-block_inner">
        <h3><?=$block->title;?></h3>
        <div class="change-block">
            <div class="">
                <p><?=$block->preview;?></p>
            </div>
            <div class="hidden">
                <?=$block->text;?>
            </div>
            <div class="more block_cut_more" data-text-show="<?=$block->text_show ? $block->text_show : 'Показать';?>"  data-text-hide="<?=$block->text_show ? $block->text_hide : 'Свернуть';?>">
                <span class="more-btn show-cut_<?=$block->id;?> tt-up">
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
        var blockCut".$block->id." = $('#cut_".$block->id."').closest('.block_cut');
        if($('.block_cut_end').length) {
            var cutEnd = blockCut".$block->id.".nextAll('.block_cut_end:first');
            elems".$block->id." = blockCut".$block->id.".nextUntil(cutEnd, '.block');
        } else {
            elems".$block->id." = blockCut".$block->id.".nextAll('.block');
        }
        elems".$block->id.".hide();

        $(document)
            .on('click','.show-cut_".$block->id."', function () {
                var id = $(this).data('id');
                $(this).parent().parent().find('.hidden').slideDown(500);
                $(this).toggleClass('show-cut_".$block->id." hide-cut_".$block->id." rotate');
                $(this).find('.more-text').text($(this).parent().data('text-hide'));
                elems".$block->id.".show();
                $(this).closest('.more').insertAfter(elems".$block->id.".last());
            })
            .on('click','.hide-cut_".$block->id."',function () {
                $(this).parent().parent().find('.hidden').slideUp(500);
                $(this).toggleClass('show-cut_".$block->id." hide-cut_".$block->id." rotate');
                $(this).find('.more-text').text($(this).parent().data('text-show'));
                elems".$block->id.".hide();
                $(this).closest('.more').appendTo($(this).closest('.block_cut .change-block'));
            });
    });
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>