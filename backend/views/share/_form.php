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
        <div class="col-sm-4">
            <?=ImageInput::widget(['model' => $model, 'attribute' => 'imageFile', 'previewAttribute' => 'image']);?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'title')->textInput() ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'text')->textarea(['rows' => 4]) ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'twitter')->textarea(['rows' => 4]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>