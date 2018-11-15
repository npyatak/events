<?php
use yii\helpers\Html;
use common\components\ElfinderInput;
?>

<div class="row block-gallery-image">
	<?= Html::activeHiddenInput($model, "[$i][$key]id") ?>
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("image") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i][$key]image", ['class' => 'control-label']) ?>
			<?= ElfinderInput::widget([
			    'model' => $model,
			    'attribute' => "[$i][$key]image",
			]);?>
			<?= Html::error($model, "[$i][$key]image", ['class' => 'help-block']);?>
		</div>
	</div>

    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i][$key]title", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i][$key]title", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i][$key]title", ['class' => 'help-block']);?>
		</div>
	</div>

    <div class="col-sm-3">
		<div class="form-group <?=$model->hasErrors("copyright") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i][$key]copyright", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i][$key]copyright", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i][$key]copyright", ['class' => 'help-block']);?>
		</div>
	</div>

    <div class="col-sm-1">
		<div class="remove-gallery-image">x</div>
	</div>
</div>