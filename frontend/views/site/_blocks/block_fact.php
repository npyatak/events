<?php 
use common\models\blocks\items\BlockFactItem;
?>

<?php if($block->blockFactItems):?>
<div class="container_inner">
    <div class="facts-many">
        <div class="row justify-content-end m-0">
            <div class="fact-many_inner m-r-40">
                <div class="title"><?=$block->title;?></div>
                <?php foreach ($block->blockFactItems as $item):?>
                <div class="item sm">
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
                                <p>Бытует мнение, будто Джорджу Лукасу не было никакого дела до Расширенной вселенной, и он не имел отношения к историям, которые сочиняли писатели, а также сценаристы комиксов и игр. Кроме того, анонс о новом статусе SW подчеркивает, что каноном остались лишь те произведения, в создании которых участвовал лично Лукас. Дескать, вот он и был универсальным критерием, по которому решалось, что оставлять в официальной истории саги.</p>
                                <p>Действительно, не раз возникали ситуации, когда Лукас своими работами перечеркивал сюжеты, придуманные другими авторами. Например, в 90-х те придумали Бобе Фетту одну биографию, а с выходом приквелов выяснилось, что она была совершенно иной. Любопытно, что несколько наиболее одиозных историй Расширенной вселенной родились при участии Джорджа. Например, именно с его подачи в серии комиксов «Тёмная империя» император Палпатин "воскрес" в виде клона.</p>
                            </div>
                        </div>
                    </div>
                    <div class="more-other">
                        <span class="more-btn-other show">
                            <span class="more-text"><?=$item->link;?></span>
                            <i class="fa fa-chevron-down"></i>
                        </span>
                    </div>
                    <?php endif;?>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php endif;?>