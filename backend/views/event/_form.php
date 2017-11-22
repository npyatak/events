<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;

use common\models\Event;
?>

<div class="district-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        //'enableAjaxValidation' => true,
        'id' => 'event-form'
    ]); ?>

    <?=$form->errorSummary($model);?>
    <?php if(!empty($blockModelsArray)):?>
        <?php foreach ($blockModelsArray as $i => $blockModel):?>
            <?php if($blockModel->hasErrors()):?>
            <div class="error-summary">
                <ul>
                    <?php foreach ($blockModel->getErrors() as $key => $error):?>
                        <li><?=$error[0];?></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>

    <div class="row">
        <div class="col-sm-7">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'view_date_type')->dropDownList($model->dateTypeList)?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'dateFormatted')->widget(
                DatePicker::className(), [
                    'pluginOptions' => [
                        // 'startView'=>'year',
                        // 'minViewMode'=>'months',
                        'format' => 'dd.mm.yyyy',
                    ]
                ]
            );?>
        </div>
    </div>

    <?= $form->field($model, 'leading_text')->textarea(['rows' => 3]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'main_page_image_url')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'image_url')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'socials_title')->textInput() ?>
            </div>

            <div class="col-sm-6">
                <?= $form->field($model, 'socials_image_url')->textInput() ?>
            </div>
        </div>

        <?= $form->field($model, 'socials_text')->textarea(['rows' => 3]) ?>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'categoryIds')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(common\models\Category::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Выберите категории'],
                'pluginOptions' => [
                    'allowClear' => false,
                    'multiple' => true,
                ],
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'similarIds')->widget(Select2::classname(), [
                'data' => $model->arrayForSimilar,
                'options' => ['placeholder' => 'Выберите связанные события'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'show_on_main')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'value_index')->dropDownList($model->valueIndexArray) ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'status')->dropDownList(Event::getStatusArray()) ?>
        </div>
    </div>

    <?=$this->render('_blocks_list', ['blockModelsArray' => $blockModelsArray]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>