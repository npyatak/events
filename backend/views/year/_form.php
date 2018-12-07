<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\CKEditor;
use yii\widgets\ActiveForm;
use backend\widgets\input\ImageInput;

\backend\widgets\input\ImageInputAsset::register($this);
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>


    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'is_current')->checkbox() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'show_on_main')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?=ImageInput::widget([
                'model' => $model, 
                'attribute' => 'mainPageImageFile', 
                'previewAttribute' => 'main_page_image',
                //'cropParams' => $model->mainPageImageCropParams, 
            ]);?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'logo_url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'leading_text')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'worked_on_project')->widget(CKEditor::className(), [
            'editorOptions' => [
                'allowedContent' => true,
                'preset' => 'textEditor'
            ]
        ]);?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'used_multimedia')->widget(CKEditor::className(), [
            'editorOptions' => [
                'allowedContent' => true,
                'preset' => 'textEditor'
            ]
        ]);?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'sources')->widget(CKEditor::className(), [
            'editorOptions' => [
                'allowedContent' => true,
                'preset' => 'textEditor'
            ]
        ]);?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'gratitude')->widget(CKEditor::className(), [
            'editorOptions' => [
                'allowedContent' => true,
                'preset' => 'textEditor'
            ]
        ]);?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'additional')->widget(CKEditor::className(), [
            'editorOptions' => [
                'allowedContent' => true,
                'preset' => 'textEditor'
            ]
        ]);?>
    </div>

    <hr>
    <h3>Баннер справа</h3>
    <div class="row">
        <div class="col-sm-3">
            <?=ImageInput::widget([
                'model' => $model, 
                'attribute' => 'partnerImageIndexFile', 
                'previewAttribute' => 'partner_image_index',
                'cropParams' => $model->partnerImageIndexCropParams, 
            ]);?>
        </div>
        <div class="col-sm-3">
            <?=ImageInput::widget([
                'model' => $model, 
                'attribute' => 'partnerImageEventFile', 
                'previewAttribute' => 'partner_image_event',
                'cropParams' => $model->partnerImageEventCropParams, 
            ]);?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'partner_text')->widget(CKEditor::className(), [
                'editorOptions' => [
                    'allowedContent' => true,
                    'preset' => 'textEditor'
                ]
            ]);?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'partner_url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>