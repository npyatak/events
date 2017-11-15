<?php
use yii\helpers\Html;
use common\components\CKEditor;
?>

<div class="form-group <?=$model->hasErrors("text") ? 'has-error' : '';?>">
	<?= Html::activeLabel($model, "[$i]text", ['class' => 'control-label']) ?>
	<?=CKEditor::widget([
	    'model' => $model,
	    'attribute' => "[$i]text",
    ]);?>
	<?= Html::error($model, "[$i]text", ['class' => 'help-block']);?>
</div>

<div class="form-group">
	<?= Html::activeLabel($model, "[$i]by_line", ['class' => 'control-label']) ?>
	<?= Html::activeTextarea($model, "[$i]by_line", ['class' => 'form-control']) ?>
</div>