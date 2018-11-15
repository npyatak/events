<?php

use yii\helpers\Html;

$this->title = 'Загрузить картинки';
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\backend\widgets\cropimage\CropImageAsset::register($this);
?>

<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-sm-9">
            <div id="image">
            	<img src="<?=Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(['/images/event/bg-lg.jpg']);?>">
            </div>
        </div>
    </div>

</div>
