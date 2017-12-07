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
                            <p><i>редактор:</i>  <b>Сабина Вахитова</b>, <b>Тимур Фехретдинов</b>.  <i>бильд-редактор:</i>  <b>Илона Грибовская</b>, <b>Павел Куколев</b>.  <i>продюсер:</i>  <b>Ольга Махмутова</b>. <i>редактор:</i>  <b>Сабина Вахитова</b>, <b>Тимур Фехретдинов</b>.  <i>бильд-редактор:</i>  <b>Илона Грибовская</b>, <b>Павел Куколев</b>.  <i>продюсер:</i>  <b>Ольга Махмутова</b>.</p>
                        </div>
                        <div class="block">
                            <h6>В проекте использованы фотографии и видео:</h6>
                            <p>ТАСС, Государственный архив Российской Федерации, Государственный центральный музей современной истории России, Фонд Государственного музея политической истории России/Сергей Смольский/ТАСС, Фонд Государственного музея революции СССР/ТАСС, FineArtImages/HeritageImages/GettyImages, UniversalHistoryArchive/UIGviaGettyImages, Sovfoto/UIGviaGettyImages, Photo12/UIG/GettyImages, SeM/UIG via Getty Images, HultonArchive/GettyImages, LibraryofCongress/Corbis/VCGviaGettyImages. GeorgeRinhart/CorbisviaGettyImages, CORBIS/CorbisviaGettyImages, Hulton-Deutsch Collection/Corbis via Getty Images, ullsteinbildviaGettyImages, Archiv Gerstenberg/ullstein bild via Getty Images, ThreeLions/GettyImages, SlavaKatamidzeCollection/GettyImages, The Print Collector/ Getty Images, Keystone/Getty Images, Roger Viollet/Getty Images, Mondadori Portfolio via Getty Images, wikimedia.org/Publicdomain,  Фото М. М. Филоненко для главы «Корниловское выступление» предоставлено информационно-правовым порталом «Закония».</p>
                        </div>
                        <div class="block">
                            <h6>Источники:</h6>
                            <p><a href="" target="_blank">ТАСС-Досье</a>, <a href="" target="_blank">gctc.ru</a>, <a href="" target="_blank">РОСКОСМОС</a>,
                                <a href="" target="_blank">NASA</a>, <a href="" target="_blank">astronaut.ru</a>, <a
                                    href="" target="_blank">asc-csa.gc.ca</a>, <a href="" target="_blank">iss.jaxa.jp</a>,
                                <a href="" target="_blank">esa.int</a>, <a href="" target="_blank">Государственный центральный музей современной истории России</a>,
                                <a href="" target="_blank">Фонд Государственного музея политической истории России</a>.</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="block">
                            <h6>ТАСС благодарит за помощь в подготовке проекта Государственный архив Российской Федерации и профессора НИУ ВШЭ, д. и. н. Будницкого О. В, а также Управление Пресс-службы и информации Президента Российской Федерации и Службу коменданта Московского Кремля ФСО России, а также сотрудника НИУ ВШЭ А. В. Латышева</h6>
                        </div>
                        <div class="block">
                            <h6>Книги, фильмы и сериалы, представленные в проекте, нам помогли выбрать пользователи социальной сети "Одноклассники"</h6>
                        </div>
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
                        <p>ТАСС информационное агентство (св-во о регистрации СМИ №03247 выдано 02 апреля 1999 г. Государственным комитетом Российской Федерации по печати). Отдельные публикации могут содержать информацию, не предназначенную для пользователей до 16 лет.</p>
                    </div>
                    <div class="col-2">ТАСС 2017</div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
