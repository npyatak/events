<?php
use yii\helpers\Html;
use common\components\CKEditor;
?>

<div class="row">
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
		<div class="form-group <?=$model->hasErrors("control_text") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]control_text", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]control_text", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]control_text", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("control_text_back") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]control_text_back", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]control_text_back", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]control_text_back", ['class' => 'help-block']);?>
		</div>
	</div>
</div>


<div class="row">
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("imageFrontFile") ? 'has-error' : '';?>">
			<?=\backend\widgets\input\ImageInput::widget([
				'model' => $model,
				'attribute' => "[$i]imageFrontFile",
				'previewAttribute' => 'image_front',
				'cropParams' => $model->imageFrontCropParams, 
			]);?>
		</div>
	</div>
    <div class="col-sm-8">
		<div class="form-group">
			<?= Html::activeLabel($model, "[$i]text_front") ?>
			<?=CKEditor::widget([
			    'model' => $model,
			    'attribute' => "[$i]text_front",
			    'editorOptions' => [
			    	'preset' => 'colorAndAlign'
			    ]
		    ]);?>
		</div>
	</div>
    <div class="col-sm-8">
		<div class="form-group <?=$model->hasErrors("capture_front") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]capture_front", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]capture_front", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]capture_front", ['class' => 'help-block']);?>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("imageBackFile") ? 'has-error' : '';?>">
			<?=\backend\widgets\input\ImageInput::widget([
				'model' => $model,
				'attribute' => "[$i]imageBackFile",
				'previewAttribute' => 'image_back',
				'cropParams' => $model->imageBackCropParams, 
			]);?>
		</div>
	</div>
    <div class="col-sm-8">
		<div class="form-group">
			<?= Html::activeLabel($model, "[$i]text_back") ?>
			<?=CKEditor::widget([
			    'model' => $model,
			    'attribute' => "[$i]text_back",
			    'editorOptions' => [
			    	'preset' => 'colorAndAlign'
			    ]
		    ]);?>
		</div>
	</div>
    <div class="col-sm-8">
		<div class="form-group <?=$model->hasErrors("capture_back") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]capture_back", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]capture_back", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]capture_back", ['class' => 'help-block']);?>
		</div>
	</div>
</div>