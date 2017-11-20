<?php
use yii\helpers\Html;
use common\components\CKEditor;
?>

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