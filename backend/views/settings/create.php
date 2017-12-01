<?php
use yii\helpers\Html;

$this->title = 'Добавить настройку';
$this->params['breadcrumbs'][] = ['label' => 'Настройки футера', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
