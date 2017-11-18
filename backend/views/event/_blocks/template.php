<?php
use yii\helpers\Html;
?>

<li class="block">
	<div class="header row">
		<div class="remove">x</div>
        <div class="col-sm-8">
			<h3><?=$model->blockName;?></h3>
		</div>
        <div class="col-sm-3">
			<?= Html::activeTextInput($model, "[$i]anchor", ['class' => 'form-control', 'placeholder' => 'Якорь #']) ?>
		</div>
	</div>

	<div class="content">
		<?php if(!$model->isNewRecord) {
			echo Html::activeHiddenInput($model, "[$i]id");
		} ?>

		<?php if(!$model->order) {
			$model->order = $i + 1;
		} ?>
		<?= Html::activeHiddenInput($model, "[$i]order", ['class' => 'hidden-order']);?>

		<?=$this->render($model->view, ['model' => $model, 'i' => $i]);?>
	</div>
</li>