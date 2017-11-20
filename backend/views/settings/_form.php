<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true]); ?>

    <?php if($model->isNewRecord) {
    	echo $form->field($model, 'key')->textInput();
    } ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'value')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>