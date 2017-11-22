<?php
use yii\helpers\Html;

$this->title = 'Изменить редактора: ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Редакторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
