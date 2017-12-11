<?php

use yii\helpers\Html;

$this->title = 'Изменить событие: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="district-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Посмотреть на сайте', $model->url, ['class' => 'btn btn-success', 'target' => '_blank']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'blockModelsArray' => $blockModelsArray,
    ]) ?>

</div>
