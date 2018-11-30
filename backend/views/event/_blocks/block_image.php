<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\CKEditor;
?>

<div class="row">
    <div class="col-sm-4">
		<div class="form-group <?=$model->hasErrors("imageFile") ? 'has-error' : '';?>">
			<?=\backend\widgets\input\ImageInput::widget([
				'model' => $model,
				'attribute' => "[$i]imageFile",
				'previewAttribute' => 'source',
			]);?>
		</div>
	</div>
    <div class="col-sm-8">
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
	</div>
</div>

<div class="row">
    <div class="col-sm-2">
		<div class="form-group inline-block">
			<?= Html::activeLabel($model, "[$i]show_fullscreen") ?>
			<?= Html::activeCheckbox($model, "[$i]show_fullscreen", ['class' => 'form-control', 'label' => false]) ?>
		</div>
	</div>
    <div class="col-sm-10">
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
	</div>
</div>