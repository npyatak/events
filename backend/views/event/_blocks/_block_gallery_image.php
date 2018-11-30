<?php
use yii\helpers\Html;
?>

<div class="row block-gallery-image">
	<div class="remove-gallery-image">&times;</div>
	<?= Html::activeHiddenInput($model, "[$i][$key]id") ?>
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("imageFile") ? 'has-error' : '';?>">
			<?=\backend\widgets\input\ImageInput::widget([
				'model' => $model,
				'attribute' => "[$i][$key]imageFile",
				'previewAttribute' => 'image',
			]);?>
		</div>
	</div>

    <div class="col-sm-8">
		<div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i][$key]title", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i][$key]title", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i][$key]title", ['class' => 'help-block']);?>
		</div>
	</div>

    <div class="col-sm-8">
		<div class="form-group <?=$model->hasErrors("copyright") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i][$key]copyright", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i][$key]copyright", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i][$key]copyright", ['class' => 'help-block']);?>
		</div>
	</div>
</div>