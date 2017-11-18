<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => true,
    //'enableAjaxValidation' => true,
    'id' => 'blocks-form'
]); ?>
	
	<?=$this->render('_blocks_list', ['blockModelsArray' => $blockModelsArray]);?>

	<div class="form-group">
	    <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']) ?>
	</div>

<?php ActiveForm::end(); ?>
