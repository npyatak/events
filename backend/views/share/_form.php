<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\ElfinderInput;
use backend\widgets\input\ImageInput;

\backend\widgets\input\ImageInputAsset::register($this);
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin([
    	'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-sm-9">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'watermark_type')->dropDownList(Yii::$app->image->watermarkTypesList()); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?=ImageInput::widget([
                'model' => $model, 
                'attribute' => 'imageFile', 
                'previewAttribute' => 'image',
                'cropParams' => $model->imageCropParams, 
            ]);?>
        </div>
        <div class="col-sm-4">
            <?=ImageInput::widget([
                'model' => $model, 
                'attribute' => 'imageFileFb', 
                'previewAttribute' => 'imageFb',
                'cropParams' => $model->imageFbCropParams, 
            ]);?>
        </div>
        <div class="col-sm-4">
            <?=ImageInput::widget([
                'model' => $model, 
                'attribute' => 'imageFileTw', 
                'previewAttribute' => 'imageTw',
                'cropParams' => $model->imageTwCropParams, 
            ]);?>
        </div>
    </div>
    
    <?= $form->field($model, 'text')->textarea(['rows' => 4, 'maxlength' => true]) ?>

    <?= $form->field($model, 'twitter')->textarea(['rows' => 4, 'maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>