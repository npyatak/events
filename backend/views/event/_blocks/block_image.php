<?php
use yii\helpers\Html;
use kartik\color\ColorInput;
?>

<div class="row">
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("source") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]source", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]source", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]source", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("url") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]url", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]url", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]url", ['class' => 'help-block']);?>
		</div>
	</div>
</div>

<div class="form-group">
	<?= Html::activeLabel($model, "[$i]text") ?>
	<?= Html::activeTextarea($model, "[$i]text", ['class' => 'form-control']) ?>
</div>

<div class="form-group">
	<?= Html::activeLabel($model, "[$i]copyright_text") ?>
	<?= Html::activeTextarea($model, "[$i]copyright_text", ['class' => 'form-control']) ?>
</div>

<div class="row">
    <div class="col-sm-4">
		<div class="form-group inline-block">
			<?= Html::activeLabel($model, "[$i]copyright_color") ?>
			<?= ColorInput::widget([
			    'model' => $model,
			    'attribute' => "[$i]copyright_color",
			]);?>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group inline-block">
			<?= Html::activeLabel($model, "[$i]float") ?>
			<?= Html::activeDropdownList($model, "[$i]float", $model->getFloatArray(), ['class' => 'form-control']) ?>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group inline-block">
			<?= Html::activeLabel($model, "[$i]show_fullscreen") ?>
			<?= Html::activeCheckbox($model, "[$i]show_fullscreen", ['class' => 'form-control', 'label' => false]) ?>
		</div>
	</div>
</div>