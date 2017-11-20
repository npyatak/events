<?php
use yii\helpers\Html;
use common\components\CKEditor;

use common\models\blocks\items\BlockFactItem;
?>

<div class="block-fact-item">
	<div class="remove-fact-item">x</div>
	<div class="row">
		<?= Html::activeHiddenInput($model, "[$i][$key]id") ?>
	    <div class="col-sm-6">
			<div class="form-group <?=$model->hasErrors("number") ? 'has-error' : '';?>">
				<?= Html::activeLabel($model, "[$i][$key]number", ['class' => 'control-label']) ?>
				<?= Html::activeTextInput($model, "[$i][$key]number", ['class' => 'form-control']) ?>
				<?= Html::error($model, "[$i][$key]number", ['class' => 'help-block']);?>
			</div>
		</div>

	    <div class="col-sm-6">
			<div class="form-group <?=$model->hasErrors("capture") ? 'has-error' : '';?>">
				<?= Html::activeLabel($model, "[$i][$key]capture", ['class' => 'control-label']) ?>
				<?= Html::activeTextInput($model, "[$i][$key]capture", ['class' => 'form-control']) ?>
				<?= Html::error($model, "[$i][$key]capture", ['class' => 'help-block']);?>
			</div>
		</div>
	</div>

	<div class="row">
	    <div class="col-sm-3">
			<div class="form-group <?=$model->hasErrors("type") ? 'has-error' : '';?>">
				<?= Html::activeLabel($model, "[$i][$key]type", ['class' => 'control-label']) ?>
				<?= Html::activeDropdownList($model, "[$i][$key]type", BlockFactItem::getTypesArray(), ['class' => 'form-control']) ?>
				<?= Html::error($model, "[$i][$key]type", ['class' => 'help-block']);?>
			</div>
	    </div>
	    <div class="col-sm-8">
			<div class="form-group <?=$model->hasErrors("link") ? 'has-error' : '';?>">
				<?= Html::activeLabel($model, "[$i][$key]link", ['class' => 'control-label']) ?>
				<?= Html::activeTextInput($model, "[$i][$key]link", ['class' => 'form-control']) ?>
				<?= Html::error($model, "[$i][$key]link", ['class' => 'help-block']);?>
			</div>
		</div>
	</div>

	<div class="form-group <?=$model->hasErrors("text") ? 'has-error' : '';?>">
		<?= Html::activeLabel($model, "[$i][$key]text", ['class' => 'control-label']) ?>
		<?=CKEditor::widget([
		    'model' => $model,
		    'attribute' => "[$i][$key]text",
		    'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                'allowedContent' => true,
		    	'preset' => 'textEditor'
		    ])
	    ]);?>
		<?= Html::error($model, "[$i][$key]text", ['class' => 'help-block']);?>
	</div>
</div>