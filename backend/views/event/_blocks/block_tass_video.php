<?php
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("imageFile") ? 'has-error' : '';?>">
			<?=\backend\widgets\input\ImageInput::widget([
				'model' => $model,
				'attribute' => "[$i]imageFile",
				'cropParams' => $model->imageCropParams, 
				'previewAttribute' => 'image',
			]);?>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]title", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]title", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]title", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-2">
		<div class="form-group <?=$model->hasErrors("width") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]width", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]width", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]width", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-2">
		<div class="form-group <?=$model->hasErrors("height") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]height", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]height", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]height", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("list_1") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]list_1", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]list_1", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]list_1", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("list_2") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]list_2", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]list_2", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]list_2", ['class' => 'help-block']);?>
		</div>
	</div>
</div>