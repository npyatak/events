<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Event;

$this->registerJsFile(Url::toRoute('js/event.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = $event->meta_title ? $event->meta_title : $event->title;
$this->registerMetaTag(['property' => 'description', 'content' => $event->meta_description]);

$share['url'] = Url::current([], true);
$share['title'] = $event->socials_title ? $event->socials_title : $this->title;
$share['text'] = $event->socials_text;
$share['image'] = Url::to($event->getImageUrl($event->socials_image_url), true);
$share['twitter'] = $event->twitter_text ? $event->twitter_text : $this->title;

$color = null;
foreach ($event->categories as $cat) {
    if(!$color) {
        $color = $cat->color;
    }
    $classes[] = 'cat_'.$cat->alias;
}

$this->registerMetaTag(['property' => 'og:description', 'content' => $share['text']], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $share['title']], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $share['image']], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $share['url']], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
?>

<div class="event-detail">
    <div class="event-background" style="background-image:url(<?=$event->image_url;?>)"></div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="event-content">
                <div class="container_inner">
                    <div class="event-header">
                        <div class="row m-0 justify-content-between">
                            <div class="event-title">
                                <h1><?=$event->title?></h1>
                                <div class="event-cat">
                                    <?php if($event->categories) {
                                        foreach ($event->categories as $cat) {
                                            echo Html::a($cat->title, $cat->url, ['rel' => 'nofollow']);
                                        }
                                    }?>
                                </div>
                            </div>
                            <div class="event-date <?=$event->view_date_type == Event::DATE_TYPE_DATE ? 'day' : '';?>">
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
                                <?php elseif($event->view_date_type == Event::DATE_UNKNOWN):?>
                                    <div class="season">
                                        <div>
                                            <span><?=date('Y', $event->date);?></span>
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
                                    <a class="add-to-calendar-a" href=""><i>+</i><span>д</span>обавить в календарь</a>
                                    <div class="hidden dropdown">
                                        <ul>
                                            <li><a class="calendar" href="<?=Url::toRoute(['site/gc', 'alias' => $event->alias]);?>" target="_blank" rel="nofollow">добавить в google календарь</a></li>
                                            <li><a class="calendar" href="<?=Url::toRoute(['site/ics', 'alias' => $event->alias]);?>" target="_blank" rel="nofollow">добавить в календарь (.ics)</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="event-inner">
                        <div class="share-block">
                            <?= \frontend\widgets\share\ShareWidget::widget([
                                'share' => $share,
                                'wrap' => 'div',
                                'wrapClass' => 'share-wrap',
                                'itemWrapClass' => 'wrap-',
                                'itemClass' => 'share-btn share',
                                'addItemClasses' => [],
                            ]);?>
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

                <?php if($event->copyright):?>
                    <div class="container_inner">
                        <div class="copyright">
                            <?=$event->copyright;?>
                        </div>
                    </div>
                <?php endif;?>

                <div class="container_inner">
                    <div class="footer">
                        <div class="row justify-content-end m-0">
                            <div class="footer-inner m-r-40">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="share-block">
                                            <?= \frontend\widgets\share\ShareWidget::widget([
                                                'share' => $share,
                                                'wrap' => 'div',
                                                'wrapClass' => 'share-wrap',
                                                'itemClass' => 'share-btn share',
                                            ]);?>
                                        </div>
                                    </div>
                                    <?php if($prevEvent || $nextEvent):?>
                                        <div class="col-6">
                                            <?php if($prevEvent):?>
                                            <div class="footer-arrow">
                                                <a href="<?=$prevEvent->url;?>" <?=$prevEvent->noFollow;?>><i class="fa fa-chevron-left"></i></a>
                                            </div>
                                            <div class="footer-title">предыдущее</div>
                                            <div class="footer-text"><a href="<?=$prevEvent->url;?>" <?=$prevEvent->noFollow;?>><?=$prevEvent->title;?></a></div>
                                            <?php endif;?>
                                        </div>
                                        <div class="col-6">
                                            <?php if($nextEvent):?>
                                            <div class="footer-arrow">
                                                <a href="<?=$nextEvent->url;?>" <?=$nextEvent->noFollow;?>><i class="fa fa-chevron-right"></i></a>
                                            </div>
                                            <div class="footer-title">следующее</div>
                                            <div class="footer-text"><a href="<?=$nextEvent->url;?>" <?=$nextEvent->noFollow;?>><?=$nextEvent->title;?></a></div>
                                            <?php endif;?>
                                        </div>
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
                    <a href="<?=$similar->url;?>" <?=$similar->noFollow;?> class="item">
                        <?php if($similar->small_image_url):?>
                        <div class="item-image" style="background-image:url(<?=$similar->getImageUrl($similar->small_image_url, '249x140');?>)">
                            <span class="bg" style="background-color:<?=$color ? $color : '';?>"></span>
                        </div>
                        <?php endif;?>
                        <div class="item-content">
                            <div class="item-title">
                                <h5 style="color:<?=$color ? $color : '';?>"><span><?=$similar->title;?></span></h5>
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

<?php if(Yii::$app->settings->get('smi2_code')):?>
    <div class="news-partners">
        <div class="container">
            <?=Yii::$app->settings->get('smi2_code');?>
        </div>
    </div>
<?php endif;?>

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
        z-index: 0;
    }
    .main-menu_btn {
        display: none;
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
";

$this->registerJs($script, yii\web\View::POS_END);?>