<?php
use yii\helpers\Html;
?>

<div class="form-group <?=$model->hasErrors("code") ? 'has-error' : '';?>">
	<?= Html::activeLabel($model, "[$i]code", ['class' => 'control-label']) ?>
	<?= Html::activeTextarea($model, "[$i]code", ['class' => 'form-control', 'rows' => 5]) ?>
	<?= Html::error($model, "[$i]code", ['class' => 'help-block']);?>
</div>