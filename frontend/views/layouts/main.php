<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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
    <title>
        <?php if(Yii::$app->settings->get('projectTitle')) {
            echo Yii::$app->settings->get('projectTitle');
        } elseif(Yii::$app->settings->get('currentYear')) {
            echo Yii::$app->settings->get('currentYear').' год. Краткое содержание. ';
        } ?>
        <?=$this->title ? '- '.Html::encode($this->title) : ''?>
    </title>
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
<?php if($_SERVER['HTTP_HOST'] !== 'events.local'):?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KX9ZXT"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php endif;?>

<?php $this->beginBody() ?>

    <div class="wrapper">
        <?= $content ?>
    </div>


<footer>
    <div class="container">
        <div class="top">
            <div class="pull-left">
                <a href="" class="footer-logo"></a>
            </div>
            <div class="pull-left">
                <div class="row justify-content-between">
                    <div class="col-8">
                        <div class="block">
                            <h6>Над проектом работали:</h6>
                            <?=Yii::$app->settings->get('workedOnProject');?>
                        </div>
                        <div class="block">
                            <h6>В проекте использованы фотографии и видео:</h6>
                            <?=Yii::$app->settings->get('usedMultimedia');?>
                        </div>
                        <div class="block">
                            <h6>Источники:</h6>                         
                            <?=Yii::$app->settings->get('sources');?>
                        </div>
                    </div>
                    <div class="col-3">
                        <?=Yii::$app->settings->get('gratitude');?>
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
                    <div class="col-2">ТАСС <?=Yii::$app->settings->get('currentYear');?></div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
