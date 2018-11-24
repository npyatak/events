<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= Html::csrfMetaTags() ?>

    <?php if(Yii::$app->controller->yearModel->title) {
        $title = Yii::$app->controller->yearModel->title;
    } else {
        $title = Yii::$app->controller->yearModel->number.' год: Краткое содержание.';
    } ?>
    <title><?=$this->title ? Html::encode($this->title).' - ' : ''?><?=$title;?></title>

    <?php $this->head() ?>

    <?php if($_SERVER['HTTP_HOST'] !== 'events.local'):?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KX9ZXT');</script>
        <!-- End Google Tag Manager -->
    <?php endif;?>
</head>
<body>
<div id="preloader">
    <div class="inner"><i class="fa fa-spin fa-refresh"></i></div>
</div>
<?php if($_SERVER['HTTP_HOST'] !== 'events.local'):?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KX9ZXT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php endif;?>
<?php $this->beginBody() ?>
    <div class="main-menu">
        <div class="container">
            <div class="container_inner">
                <div class="logo"><a href="<?=Yii::$app->controller->yearModel->logo_url;?>" target="_blank"></a></div>
                <div class="main-slogan"><h2><a href="<?=Url::home();?>"><?=$title;?></a></h2></div>
                <div class="right">
                    <?php if(Yii::$app->controller->action->id == 'index'):?>
                    <div class="main-menu_share">
                        <span class="main-share_btn"><i class="ion-android-share"></i></span>
                        <div class="main-menu_share-wrap">
                            <?php $this->params['share']['url'] = Url::canonical();?>
                            <?= \frontend\widgets\share\ShareWidget::widget([
                                'share' => $this->params['share'],
                                'itemClass' => 'btn-share share',
                                'addItemClasses' => ['fb' => 'btn-facebook', 'tw' => 'btn-twitter', 'ok' => 'btn-odnoklassniki', 'vk' => 'btn-vk', 'tg' => 'btn-telegram']
                            ]);?>
                        </div>
                    </div>
                    <?php endif;?>
                    <div class="main-menu_btn"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <?= $content ?>
    </div>

<?php if(Yii::$app->controller->action->id !== 'error'):?>
<footer>
    <div class="container">
        <div class="top">
            <div class="pull-left">
                <a href="<?=Yii::$app->controller->yearModel->logo_url;?>" target="_blank" class="footer-logo"></a>
            </div>
            <div class="pull-left">
                <div class="row justify-content-between">
                    <div class="col-8">
                        <?php if(Yii::$app->controller->yearModel->worked_on_project):?>
                            <div class="block">
                                <h6>Над проектом работали:</h6>
                                <?=Yii::$app->controller->yearModel->worked_on_project;?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->controller->yearModel->used_multimedia):?>
                            <div class="block">
                                <h6><?=Yii::$app->controller->yearModel->used_multimedia_label;?></h6>
                                <?=Yii::$app->controller->yearModel->used_multimedia;?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->controller->yearModel->sources):?>
                            <div class="block">
                                <h6>Источники:</h6>                         
                                <?=Yii::$app->controller->yearModel->sources;?>
                            </div>
                        <?php endif;?>
                    </div>
                    <div class="col-3">
                        <?php if(Yii::$app->controller->yearModel->gratitude):?>
                            <div class="block">
                                <h6>Благодарности:</h6>                         
                                <?=Yii::$app->controller->yearModel->gratitude;?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->controller->yearModel->additional):?>
                            <div class="block">
                                <?=Yii::$app->controller->yearModel->additional;?>
                            </div>
                        <?php endif;?>
                        <?php if(Yii::$app->controller->yearModel->partner_text):?>
                            <div class="block">
                                <p>
                                    <?=Yii::$app->controller->yearModel->partner_url ? 
                                        Html::a(Yii::$app->controller->yearModel->partner_text, Yii::$app->controller->yearModel->partner_url) :
                                        Yii::$app->controller->yearModel->partner_text;
                                    ?>
                                </p>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="pull-left">

            </div>
            <div class="pull-left">
                <div class="row justify-content-between">
                    <div class="col-8">
                        <?=Yii::$app->settings->get('proviso');?>
                    </div>
                    <div class="col-2"><span class="footer-tass"><?=Yii::$app->settings->get('copyright');?></span></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php endif;?>

<?php if($_SERVER['HTTP_HOST'] !== 'events.local'):?>
<script>!function(e,t,d,s,a,n,c){e[a]={},e[a].date=(new Date).getTime(),n=t.createElement(d),c=t.getElementsByTagName(d)[0],n.type="text/javascript",n.async=!0,n.src=s,c.parentNode.insertBefore(n,c)}(window,document,"script","https://eventstassru.push.world/embed.js","pw"),pw.websiteId="ef40dc0cbad840e00bf0911ed156274d626126cbdd2f632d8c27dce447930a93";</script>
<?php endif;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
