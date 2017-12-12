<?php
use yii\helpers\Html;
use common\components\CKEditor;
use common\components\ElfinderInput;
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
    <div class="col-sm-8">
		<div class="form-group <?=$model->hasErrors("control_text") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]control_text", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]control_text", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]control_text", ['class' => 'help-block']);?>
		</div>
	</div>
</div>

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

<div class="row">
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("image_front") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]image_front", ['class' => 'control-label']) ?>
			<?= ElfinderInput::widget([
			    'model' => $model,
			    'attribute' => "[$i]image_front",
			]);?>
			<?= Html::error($model, "[$i]image_front", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("capture_front") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]capture_front", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]capture_front", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]capture_front", ['class' => 'help-block']);?>
		</div>
	</div>
</div>

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

<div class="row">
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("image_back") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]image_back", ['class' => 'control-label']) ?>
			<?= ElfinderInput::widget([
			    'model' => $model,
			    'attribute' => "[$i]image_back",
			]);?>
			<?= Html::error($model, "[$i]image_back", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-6">
		<div class="form-group <?=$model->hasErrors("capture_back") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]capture_back", ['class' => 'control-label']) ?>
			<?= Html::activeTextInput($model, "[$i]capture_back", ['class' => 'form-control']) ?>
			<?= Html::error($model, "[$i]capture_back", ['class' => 'help-block']);?>
		</div>
	</div>
</div>