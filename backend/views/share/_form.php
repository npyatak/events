<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\ElfinderInput;
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true]); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'image')->widget(ElfinderInput::className());?>

    <?= $form->field($model, 'text')->textarea() ?>

    <?= $form->field($model, 'twitter')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>