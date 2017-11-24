<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true]); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'alias')->textInput() ?>

	<?= $form->field($model, 'color')->widget(ColorInput::classname(), [
	    'options' => [],
	]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>