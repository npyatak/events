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


<?php 
$useragent=$_SERVER['HTTP_USER_AGENT'];
$this->params['is_mobile'] = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));

if($this->params['is_mobile']) {
    $imageUrl = $event->getImageUrl($event->mobile_image_url);
} else {
    $imageUrl = $event->getImageUrl($event->image_url);
}?>

<div class="event-detail">
    <div class="event-background" style="background-image:url(<?=$imageUrl;?>)"></div>
    <div class="container">
        <div class="row justify-content-between">


            <aside class="no_main">
                <div class="partner_refer">
                    <div class="partner_img">
                        <p class="text">Не нашли ничего на свой вкус?</p>
                    </div>
                    <a href="#" class="red">
                        <p>Попробуйте поискать <span>здесь</span></p>
                    </a>
                </div>

            </aside>



            

            <div class="event-content">

                <div class="container_inner">
                    <div class="event-header">
                        <div class="row m-0 justify-content-between right_wrap">
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


    $(document).ready(function () {
;

        function right_aside() {
            var cont = $('.container').width();
            var win_width = $(window).width();
            $('aside').css({right:((win_width - cont) / 2) - 20});
        }

        right_aside();

        $(window).resize(function () {
            right_aside();

        });
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>

