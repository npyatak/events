<?php
use yii\helpers\Html;

$this->title = 'Изменить данные: ' . $model->month;
$this->params['breadcrumbs'][] = ['label' => 'Поделиться', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
