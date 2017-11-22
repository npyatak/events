<?php
use yii\helpers\Html;

$this->title = 'Добавить редактора';
$this->params['breadcrumbs'][] = ['label' => 'Редакторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
