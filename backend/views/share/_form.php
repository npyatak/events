<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true]); ?>

    <?= $form->field($model, 'title')->textarea() ?>

    <?= $form->field($model, 'image')->textarea() ?>

    <?= $form->field($model, 'text')->textarea() ?>

    <?= $form->field($model, 'twitter')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>