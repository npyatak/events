<?php
use yii\helpers\Html;
use common\components\CKEditor;

use common\models\blocks\items\BlockCardItem;
?>

<div class="block-card-item">
	<div class="remove-card-item">&times;</div>
	<div class="row">
		<?= Html::activeHiddenInput($model, "[$i][$key]id") ?>
	    <div class="col-sm-9">
			<div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
				<?= Html::activeLabel($model, "[$i][$key]title", ['class' => 'control-label']) ?>
				<?= Html::activeTextInput($model, "[$i][$key]title", ['class' => 'form-control']) ?>
				<?= Html::error($model, "[$i][$key]title", ['class' => 'help-block']);?>
			</div>
		</div>

	    <div class="col-sm-3">
			<div class="form-group <?=$model->hasErrors("icon") ? 'has-error' : '';?>">
				<?= Html::activeLabel($model, "[$i][$key]icon", ['class' => 'control-label']) ?>
				<?= Html::activeDropdownList($model, "[$i][$key]icon", BlockCardItem::getIconsArray(), ['class' => 'form-control', 'prompt' => ' ']) ?>
				<?= Html::error($model, "[$i][$key]icon", ['class' => 'help-block']);?>
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