<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\CKEditor;
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true]); ?>

    <?php if($model->isNewRecord) {
    	echo $form->field($model, 'key')->textInput();
    } ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'value')->widget(CKEditor::classname(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
            'allowedContent' => true,
            'preset' => 'basic'
        ])
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>