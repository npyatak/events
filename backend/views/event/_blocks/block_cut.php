<?php
use yii\helpers\Html;
use common\components\CKEditor;
?>

<div class="row">
	<div class="col-sm-6">
	    <div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
	        <?= Html::activeLabel($model, "[$i]title", ['class' => 'control-label']) ?>
	        <?= Html::activeTextInput($model, "[$i]title", ['class' => 'form-control']) ?>
	        <?= Html::error($model, "[$i]title", ['class' => 'help-block']);?>
	    </div>
	</div>

	<div class="col-sm-6">
	    <div class="form-group <?=$model->hasErrors("preview") ? 'has-error' : '';?>">
	        <?= Html::activeLabel($model, "[$i]preview", ['class' => 'control-label']) ?>
	        <?= Html::activeTextInput($model, "[$i]preview", ['class' => 'form-control']) ?>
	        <?= Html::error($model, "[$i]preview", ['class' => 'help-block']);?>
	    </div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
	    <div class="form-group <?=$model->hasErrors("text_show") ? 'has-error' : '';?>">
	        <?= Html::activeLabel($model, "[$i]text_show", ['class' => 'control-label']) ?>
	        <?= Html::activeTextInput($model, "[$i]text_show", ['class' => 'form-control']) ?>
	        <?= Html::error($model, "[$i]text_show", ['class' => 'help-block']);?>
	    </div>
	</div>

	<div class="col-sm-6">
	    <div class="form-group <?=$model->hasErrors("text_hide") ? 'has-error' : '';?>">
	        <?= Html::activeLabel($model, "[$i]text_hide", ['class' => 'control-label']) ?>
	        <?= Html::activeTextInput($model, "[$i]text_hide", ['class' => 'form-control']) ?>
	        <?= Html::error($model, "[$i]text_hide", ['class' => 'help-block']);?>
	    </div>
	</div>
</div>

<div class="form-group <?=$model->hasErrors("text") ? 'has-error' : '';?>">
	<?= Html::activeLabel($model, "[$i]text", ['class' => 'control-label']) ?>
	<?=CKEditor::widget([
	    'model' => $model,
	    'attribute' => "[$i]text",
	    'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'allowedContent' => true,
	    	'preset' => 'textEditor'
	    ])
    ]);?>
	<?= Html::error($model, "[$i]text", ['class' => 'help-block']);?>
</div>