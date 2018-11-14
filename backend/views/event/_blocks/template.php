<?php
use yii\helpers\Html;
?>

<?php if(!$model->order) {
	$model->order = $i + 1;
} ?>

<li class="block">
	<div class="header row">
		<div class="remove">x</div>
        <div class="col-sm-2 order-controls">
        	<span class="order-number"><?=$model->order;?></span>
			<a href="" class="move-up"><span class="glyphicon glyphicon-arrow-up"></span></a>
			<a href="" class="move-down"><span class="glyphicon glyphicon-arrow-down"></span></a>
		</div>
        <div class="col-sm-6">
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

		<?= Html::activeHiddenInput($model, "[$i]order", ['class' => 'hidden-order']);?>

		<?=$this->render($model->view, ['model' => $model, 'i' => $i]);?>
	</div>
</li>