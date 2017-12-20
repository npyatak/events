<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->context->layout = 'error';

$this->title = $name;
?>
<div class="site-error">
    <div class="error-menu">
        <div class="container">
            <div class="left">
                <a href="<?=Yii::$app->settings->get('logoUrl');?>" target="_blank" class="logo"></a>
            </div>
            <div class="left">
                <h2><a href="<?=Url::home();?>"><?=Yii::$app->settings->get('projectTitle');?></a></h2>
            </div>
        </div>
    </div>
    <div class="error-content">
        <div class="container">
            <div class="error-img">
                <img src="<?=Url::to('/images/error/404-infinite.svg');?>" alt="404">
            </div>
            <div class="error-text">
                <h2>Страница не найдена...</h2>
                <p>Возможно вы ввели не правильный адрес или страница была удалена.</p>
                <p>Попробуйте перейти на <a href="<?=Url::home();?>">главную страницу</a>.</p>
            </div>
        </div>
    </div>
</div>
