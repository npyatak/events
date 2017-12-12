<?php
use yii\helpers\Html;
use common\components\CKEditor;
use common\components\ElfinderInput;
?>

<div class="row">
    <div class="col-sm-10">
		<div class="form-group <?=$model->hasErrors("source") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]source", ['class' => 'control-label']) ?>
			<?= ElfinderInput::widget([
			    'model' => $model,
			    'attribute' => "[$i]source",
			]);?>
			<?= Html::error($model, "[$i]source", ['class' => 'help-block']);?>
		</div>
	</div>
    <div class="col-sm-2">
		<div class="form-group inline-block">
			<?= Html::activeLabel($model, "[$i]show_fullscreen") ?>
			<?= Html::activeCheckbox($model, "[$i]show_fullscreen", ['class' => 'form-control', 'label' => false]) ?>
		</div>
	</div>
</div>

<div class="form-group">
	<?= Html::activeLabel($model, "[$i]text") ?>
	<?=CKEditor::widget([
	    'model' => $model,
	    'attribute' => "[$i]text",
	    'editorOptions' => [
	    	'preset' => 'linkOnly'
	    ]
    ]);?>
</div>

<div class="form-group">
	<?= Html::activeLabel($model, "[$i]copyright_text") ?>
	<?=CKEditor::widget([
	    'model' => $model,
	    'attribute' => "[$i]copyright_text",
	    'editorOptions' => [
	    	'preset' => 'colorAndAlign'
	    ]
    ]);?>
</div>