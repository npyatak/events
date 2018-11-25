<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\CKEditor;
use common\components\ElfinderInput;

use common\models\Event;
?>

<div class="row">
    <div class="col-sm-3">
		<div class="form-group <?=$model->hasErrors("source") ? 'has-error' : '';?>">
			<?= Html::activeLabel($model, "[$i]imageFile", ['class' => 'control-label']) ?>
			<?= \dosamigos\fileinput\FileInput::widget([
			    'model' => $model,
			    'attribute' => "[$i]imageFile",
                'thumbnail' => Html::img((new Event)->getImageUrl($model->source)),
                'style' => \dosamigos\fileinput\FileInput::STYLE_CUSTOM,
                'customView' => Yii::getAlias('@backend').'/components/fileuploader/template.php',
			]);?>
			<?= Html::error($model, "[$i]imageFile", ['class' => 'help-block']);?>
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