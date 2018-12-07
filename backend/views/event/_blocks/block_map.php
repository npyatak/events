<?php
use yii\helpers\Html;
?>

<a href="https://yandex.ru/map-constructor/" target="_blank">Конструктор карт</a>

<div class="form-group <?=$model->hasErrors("code") ? 'has-error' : '';?>">
	<?= Html::activeLabel($model, "[$i]code", ['class' => 'control-label']) ?>
	<?= Html::activeTextarea($model, "[$i]code", ['class' => 'form-control', 'rows' => 5, 'maxlength' => true]) ?>
	<?= Html::error($model, "[$i]code", ['class' => 'help-block']);?>
</div>

<div class="form-group <?=$model->hasErrors("caption") ? 'has-error' : '';?>">
	<?= Html::activeLabel($model, "[$i]caption", ['class' => 'control-label']) ?>
	<?= Html::activeTextInput($model, "[$i]caption", ['class' => 'form-control', 'maxlength' => true]) ?>
	<?= Html::error($model, "[$i]caption", ['class' => 'help-block']);?>
</div>