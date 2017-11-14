<?php
use yii\helpers\Html;
use common\components\CKEditor;
?>

<div class="form-group">
	<?= Html::activeLabel($model, "[$i]text") ?>
	<?=CKEditor::widget([
	    'model' => $model,
	    'attribute' => "[$i]text",
    ]);?>
</div>

<div class="form-group">
	<?= Html::activeLabel($model, "[$i]by_line") ?>
	<?= Html::activeTextarea($model, "[$i]by_line", ['class' => 'form-control']) ?>
</div>