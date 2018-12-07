<?php
use yii\helpers\Html;
use common\components\CKEditor;
?>

<div class="form-group <?=$model->hasErrors("text") ? 'has-error' : '';?>">
	<?= Html::activeLabel($model, "[$i]text", ['class' => 'control-label']) ?>
	<?=CKEditor::widget([
	    'model' => $model,
	    'attribute' => "[$i]text",
	    'editorOptions' => [
            'allowedContent' => true,
	    	'preset' => 'textEditor'
	    ]
    ]);?>
	<?= Html::error($model, "[$i]text", ['class' => 'help-block']);?>
</div>

<div class="row">
    <div class="col-sm-3">
		<div class="form-group">
			<?=\backend\widgets\input\ImageInput::widget([
				'model' => $model,
				'attribute' => "[$i]authorImageFile",
				'cropParams' => $model->authorImageCropParams, 
				'previewAttribute' => 'author_image',
			]);?>
		</div>
	</div>
    <div class="col-sm-9">
		<div class="form-group <?=$model->hasErrors("author_name") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]author_name") ?>
			<?= Html::activeTextInput($model, "[$i]author_name", ['class' => 'form-control', 'maxlength' => true]) ?>
			<?= Html::error($model, "[$i]author_name", ['class' => 'help-block']);?>
		</div>
		<div class="form-group">
			<?= Html::activeLabel($model, "[$i]author_text") ?>
			<?=CKEditor::widget([
			    'model' => $model,
			    'attribute' => "[$i]author_text",
			    'editorOptions' => [
		            'allowedContent' => true,
			    	'preset' => 'textEditor',
			    	'height' => 100,
			    ]
		    ]);?>
		</div>
	</div>
</div>