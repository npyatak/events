<?php
use yii\helpers\Html;
use common\components\ElfinderInput;
?>

<div class="row">
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]title", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]title", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]title", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("image") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]image", ['class' => 'control-label']) ?>
			<?= ElfinderInput::widget([
			    'model' => $model,
			    'attribute' => "[$i]image",
			]);?>
			<?= Html::error($model, "[$i]image", ['class' => 'help-block']);?>
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
</div>

<div class="row">
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("list_1") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]list_1", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]list_1", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]list_1", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("list_2") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]list_2", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]list_2", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]list_2", ['class' => 'help-block']);?>
		</div>
	</div>
</div>