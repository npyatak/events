<?php
use yii\helpers\Html;

$this->title = 'Добавить год';
$this->params['breadcrumbs'][] = ['label' => 'Годы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
