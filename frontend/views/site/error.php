<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $name;
?>
<style>
    .main-menu {
        display: none !important;
    }
</style>
<div class="site-error">
    <div class="error-menu">
        <div class="container">
            <div class="left">
                <a href="<?=Url::home();?>" class="logo"></a>
            </div>
            <div class="left"><h2><?=Yii::$app->settings->get('projectTitle');?></h2></div>
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
