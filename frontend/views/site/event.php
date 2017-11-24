<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\Event;

$this->title = $event->title;

$url = Url::canonical();
$title = $event->socials_title ? $event->socials_title : $this->title;
$desc = $event->socials_text;
$image = $event->socials_image_url;

$this->registerMetaTag(['property' => 'og:description', 'content' => $desc], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
?>

<div class="main-menu"></div>
<div class="event-detail">
    <div class="event-background" style="background-image:url(<?=$event->image_url;?>)">
        <div class="event-background_caption">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="event-background_caption-inner">
                        Фотография<br>
                        Пресс-служба правительства РФ/ТАСС<br>
                        Александр Астафьев
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="event-content">
                <div class="container_inner">
                    <div class="event-header">
                        <div class="row m-0 justify-content-between">
                            <div class="event-title">
                                <h2><?=$event->title?></h2>
                            </div>
                            <div class="event-date">
                            	<?php if($event->view_date_type == Event::DATE_TYPE_DATE):?>

                                <?php elseif($event->view_date_type == Event::DATE_TYPE_MONTH_AND_YEAR):?>

                                <?php else:?>
                                    <div class="season">
                                        <div>
                                            <span><?=$event->viewDate[0];?></span>
                                            <span><?=$event->viewDate[1];?></span>
                                        </div>
                                    </div>
                            	<?php endif;?>

                                <div class="add-to-calendar">
                                    <a class="add-to-calendar-a" href="">добавить в календарь</a>
                                    <div class="hidden">
                                        <a class="calendar" href="<?=Url::toRoute(['site/ics', 'id' => $event->id]);?>" target="_blank">сохранить ics-файл</a>
                                        <a class="calendar" href="<?=Url::toRoute(['site/gc', 'id' => $event->id]);?>" target="_blank">сохранить в google Календарь</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="event-cat">
                        	<?php if($event->categories) {
                            	foreach ($event->categories as $cat) {
                            		echo Html::a($cat->title, $cat->url);
                            	}
                            }?>
                        </div>
                    </div>
                    <div class="event-inner">
                        <div class="share-block">
                            <div class="share-wrap">
                                <a href="" class="share-btn btn-facebook"><i class="fa fa-facebook"></i></a>
                                <span class="share-counter">40</span>
                            </div>
                            <div class="share-wrap">
                                <a href="" class="share-btn btn-twitter"><i class="fa fa-twitter"></i></a>
                                <span class="share-counter">31</span>
                            </div>
                            <div class="share-wrap">
                                <a href="" class="share-btn btn-odnoklassniki"><i class="fa fa-odnoklassniki"></i></a>
                                <span class="share-counter">5</span>
                            </div>
                            <div class="share-wrap">
                                <a href="" class="share-btn btn-vk"><i class="fa fa-vk"></i></a>
                                <span class="share-counter">24</span>
                            </div>
                            <div class="share-wrap">
                                <a href="" class="share-btn btn-telegram"><i class="fa fa-telegram"></i></a>
                                <span class="share-counter">1</span>
                            </div>
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
                                    <div class="col-6">
                                        <div class="footer-arrow">
                                            <a href=""><i class="fa fa-chevron-left"></i></a>
                                        </div>
                                        <div class="footer-title">предыдущее</div>
                                        <div class="footer-text"><a href="">Орбитальный телескоп Hubble сменит мощный James Webb октябрь</a></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="footer-arrow">
                                            <a href=""><i class="fa fa-chevron-right"></i></a>
                                        </div>
                                        <div class="footer-title">следующее</div>
                                        <div class="footer-text"><a href="">Орбитальный телескоп Hubble сменит мощный James Webb октябрь</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="more-events">
                <div class="more-events_title">похожие события</div>
                <a href="" class="item">
                    <div class="item-image" style="background-image:url('images/more_events/Layer_86.jpg')"></div>
                    <div class="item-content">
                        <div class="item-title">
                            <h5>Запуск телескопа James Webb отложили до 2019 года</h5>
                        </div>
                        <div class="item-date">12 апреля</div>
                    </div>
                </a>
                <a href="" class="item">
                    <div class="item-image" style="background-image:url('images/more_events/Layer_86.jpg')"></div>
                    <div class="item-content">
                        <div class="item-title">
                            <h5>Запуск телескопа James Webb отложили до 2019 года</h5>
                        </div>
                        <div class="item-date">12 апреля</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


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