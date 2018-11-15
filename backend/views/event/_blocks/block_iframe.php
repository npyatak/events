<?php
use yii\helpers\Html;
use common\components\CKEditor;
?>

<div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
    <?= Html::activeLabel($model, "[$i]title", ['class' => 'control-label']) ?>
    <?= Html::activeTextInput($model, "[$i]title", ['class' => 'form-control']) ?>
    <?= Html::error($model, "[$i]title", ['class' => 'help-block']);?>
</div>
    
<div class="form-group <?=$model->hasErrors("code") ? 'has-error' : '';?>">
	<?= Html::activeLabel($model, "[$i]code", ['class' => 'control-label']) ?>
	<?=CKEditor::widget([
	    'model' => $model,
	    'attribute' => "[$i]code",
	    'editorOptions' => [
            'allowedContent' => true,
	    	'preset' => 'iFrameOnly'
	    ]
    ]);?>
	<?= Html::error($model, "[$i]code", ['class' => 'help-block']);?>
</div>