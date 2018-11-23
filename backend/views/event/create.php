<?php

use yii\helpers\Html;

$this->title = 'Добавить событие';
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'blockModelsArray' => $blockModelsArray,
        'eventImagesFormArray' => $eventImagesFormArray,
    ]) ?>

</div>
