<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Event;

$this->registerJsFile(Url::toRoute('js/event.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = $event->title;

$url = Url::canonical();
$title = $event->socials_title ? $event->socials_title : $this->title;
$desc = $event->socials_text;
$image = $event->getImageUrl($event->socials_image_url);

$this->registerMetaTag(['property' => 'og:description', 'content' => $desc], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
?>

<!--<div class="main-menu event-detail_menu">-->
<!--    <div class="container">-->
<!--        <div class="container_inner">-->
<!--            <div class="logo"><a href="--><?//=Url::home();?><!--"></a></div>-->
<!--            <div class="main-slogan"><h2>События 2018</h2></div>-->
<!--            <div class="right">-->
<!--                <div class="main-menu_share">-->
<!--                    <span class="main-share_btn"><i class="ion-android-share"></i></span>-->
<!--                </div>-->
<!--                <div class="main-menu_btn"></div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="event-detail">
    <div class="event-background" style="background-image:url(<?=$event->image_url;?>)"></div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="event-content">
                <div class="container_inner">
                    <div class="event-header">
                        <div class="row m-0 justify-content-between">
                            <div class="event-title">
                                <h2><?=$event->title?></h2>
                                <div class="event-cat">
                                    <?php if($event->categories) {
                                        foreach ($event->categories as $cat) {
                                            echo Html::a($cat->title, $cat->url);
                                        }
                                    }?>
                                </div>
                            </div>
                            <div class="event-date <?php if($event->view_date_type == Event::DATE_TYPE_DATE):?>day<?php endif;?>">
                            	<?php if($event->view_date_type == Event::DATE_TYPE_DATE):?>
                                    <div class="season">
                                        <div>
                                            <span><?=$event->viewDate[0];?></span>
                                            <span><?=$event->viewDate[1];?></span>
                                        </div>
                                    </div>
                                <?php elseif($event->view_date_type == Event::DATE_TYPE_MONTH_AND_YEAR):?>
                                    <div class="season">
                                        <div>
                                            <span><?=$event->viewDate[0];?></span>
                                            <span><?=$event->viewDate[1];?></span>
                                        </div>
                                    </div>
                                <?php else:?>
                                    <div class="season">
                                        <div>
                                            <span><?=$event->viewDate[0];?></span>
                                            <span><?=$event->viewDate[1];?></span>
                                        </div>
                                    </div>
                            	<?php endif;?>

                                <div class="add-to-calendar">
                                    <a class="add-to-calendar-a" href=""><span>д</span>обавить в календарь</a>
                                    <div class="hidden dropdown">
                                        <ul>
                                            <li><a class="calendar" href="<?=Url::toRoute(['site/gc', 'alias' => $event->alias]);?>" target="_blank">сохранить в google Календарь</a></li>
                                            <li><a class="calendar" href="<?=Url::toRoute(['site/ics', 'alias' => $event->alias]);?>" target="_blank">сохранить ics-файл</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-inner">
                        <div class="share-block">
                            <div class="share-wrap wrap-fb">
                                <?=Html::a('<i class="fa fa-facebook"></i>', '', [
                                    'class' => 'share-btn share',
                                    'data-type' => 'fb',
                                    'data-url' => $url,
                                    'data-title' => $title,
                                    'data-image' => $image,
                                    'data-desc' => $desc,
                                ]);?>
                                <span class="share-counter"></span>
                            </div>
                            <div class="share-wrap wrap-vk">
                                <?=Html::a('<i class="fa fa-vk"></i>', '', [
                                    'class' => 'share-btn share',
                                    'data-type' => 'vk',
                                    'data-url' => $url,
                                    'data-title' => $title,
                                    'data-image' => $image,
                                    'data-desc' => $desc,
                                ]);?>
                                <span class="share-counter"></span>
                            </div>
                            <div class="share-wrap wrap-tw">
                                <?=Html::a('<i class="fa fa-twitter"></i>', '', [
                                    'class' => 'share-btn share',
                                    'data-type' => 'tw',
                                    'data-url' => $url,
                                    'data-title' => $title,
                                ]);?>
                                <span class="share-counter"></span>
                            </div>
                            <div class="share-wrap wrap-ok">
                                <?=Html::a('<i class="fa fa-odnoklassniki"></i>', '', [
                                    'class' => 'share-btn share',
                                    'data-type' => 'ok',
                                    'data-url' => $url,
                                    'data-desc' => $desc,
                                ]);?>
                                <span class="share-counter"></span>
                            </div>
                            <div class="share-wrap wrap-tg">
                                <?=Html::a('<i class="fa fa-telegram"></i>', '', [
                                    'class' => 'share-btn share',
                                    'data-type' => 'tg',
                                    'data-url' => $url,
                                    'data-desc' => $title,
                                ]);?>
                                <span class="share-counter"></span>
                            </div>
                        </div>

                        <div class="block_content">
                            <h4 class="lid"><?=$event->leading_text;?></h4>
                        </div>
                        
                        <?php if($event->eventBlocks) {
                            foreach ($event->eventBlocks as $eventBlock) {
                                echo $this->render('_blocks/template', ['eventBlock' => $eventBlock]);
                            }
                        }?>
                    </div>
                </div>

                <div class="container_inner">
                    <div class="footer">
                        <div class="row justify-content-end m-0">
                            <div class="footer-inner m-r-40">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="share-block">
                                            <div class="share-wrap">
                                                <a href="" class="share-btn btn-facebook"><i class="fa fa-facebook"></i></a>
                                            </div>
                                            <div class="share-wrap">
                                                <a href="" class="share-btn btn-twitter"><i class="fa fa-twitter"></i></a>
                                            </div>
                                            <div class="share-wrap">
                                                <a href="" class="share-btn btn-odnoklassniki"><i class="fa fa-odnoklassniki"></i></a>
                                            </div>
                                            <div class="share-wrap">
                                                <a href="" class="share-btn btn-vk"><i class="fa fa-vk"></i></a>
                                            </div>
                                            <div class="share-wrap">
                                                <a href="" class="share-btn btn-telegram"><i class="fa fa-telegram"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($prevEvent || $nextEvent):?>
                                        <?php if($prevEvent):?>
                                        <div class="col-6">
                                            <div class="footer-arrow">
                                                <a href="<?=$prevEvent->url;?>"><i class="fa fa-chevron-left"></i></a>
                                            </div>
                                            <div class="footer-title">предыдущее</div>
                                            <div class="footer-text"><a href="<?=$prevEvent->url;?>"><?=$prevEvent->title;?></a></div>
                                        </div>
                                        <?php endif;?>
                                        <?php if($nextEvent):?>
                                        <div class="col-6">
                                            <div class="footer-arrow">
                                                <a href="<?=$nextEvent->url;?>"><i class="fa fa-chevron-right"></i></a>
                                            </div>
                                            <div class="footer-title">следующее</div>
                                            <div class="footer-text"><a href="<?=$nextEvent->url;?>"><?=$nextEvent->title;?></a></div>
                                        </div>
                                        <?php endif;?>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(!empty($event->similarIds)):?>
            <div class="more-events">
                <div class="more-events_title">похожие события</div>
                <?php foreach ($event->similarEvents as $similar):?>
                    <a href="<?=$similar->url;?>" class="item">
                        <?php if($similar->small_image_url):?>
                        <div class="item-image" style="background-image:url(<?=$similar->getImageUrl($similar->small_image_url, '249x140');?>)"></div>
                        <?php endif;?>
                        <div class="item-content">
                            <div class="item-title">
                                <h5><?=$similar->title;?></h5>
                            </div>
                            <div class="item-date"><?=$similar->viewDate[0];?> <?=$similar->viewDate[1];?></div>
                        </div>
                    </a>
                <?php endforeach;?>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<div class="big-image_modal">
    <div class="big-image_modal-inner">
        <div class="big-image_modal-content">
            <div class="big-image_inner">
                <img class="img-block" src="" alt="Title">
                <div class="caption">
                    
                </div>
                <span class="big-image_modal-close"><i class="ion-android-close"></i></span>
            </div>
        </div>
    </div>
</div>
<style>
    .main-menu .main-slogan {
        padding-left: 30px;
        opacity: 1;
    }
</style>

<?php $script = "
    $(document).on('click', '.add-to-calendar-a', function() {
        $(this).parent().find('div').show();

        return false;
    });

    $(document).on('click', 'body', function() {
        $('.add-to-calendar div').hide();
    });

    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '".Url::toRoute(['site/share-counts', 'url' => $url])."',
            success: function (data) {
                data = eval('(' + data + ')');
                $.each(data, function() {
                    $('.wrap-'+this.soc).find('.share-counter').html(this.count)
                })
            },
        });
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>