<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

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
            $title = Yii::$app->settings->get('projectTitle');
        } elseif(Yii::$app->settings->get('currentYear')) {
            $title = Yii::$app->settings->get('currentYear').' год. Краткое содержание. ';
        } ?>
        <?=$title;?> <?=$this->title ? '- '.Html::encode($this->title) : ''?>
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

<?php if($_SERVER['HTTP_HOST'] !== 'events.local'):?>
<script>!function(e,t,d,s,a,n,c){e[a]={},e[a].date=(new Date).getTime(),n=t.createElement(d),c=t.getElementsByTagName(d)[0],n.type="text/javascript",n.async=!0,n.src=s,c.parentNode.insertBefore(n,c)}(window,document,"script","https://eventstassru.push.world/embed.js","pw"),pw.websiteId="ef40dc0cbad840e00bf0911ed156274d626126cbdd2f632d8c27dce447930a93";</script>
<?php endif;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
