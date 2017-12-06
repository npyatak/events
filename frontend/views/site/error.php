<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="error-menu">
        <div class="container">
            <div class="left">
                <a href="" class="logo"></a>
            </div>
            <div class="left"><h2>2018. Краткое содержание</h2></div>
        </div>
    </div>
    <div class="error-content">
        <div class="container">
            <img src="<?=Url::to('images/error/404-infinite.svg');?>" alt="404">
        </div>
    </div>
</div>
