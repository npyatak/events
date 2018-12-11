<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use common\components\ElfinderInput;
use common\components\CKEditor;
use backend\widgets\input\ImageInput;

use common\models\Event;

\backend\widgets\input\ImageInputAsset::register($this);
?>

<div class="event-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        //'enableAjaxValidation' => true,
        'id' => 'event-form',
        'options' => ['enctype' => 'multipart/form-data'],
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
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'short_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'show_on_main')->checkbox() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'value_index')->dropDownList($model->valueIndexArray) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'size')->dropDownList($model->sizeArray) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'status')->dropDownList(Event::getStatusArray()) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'view_date_type')->dropDownList($model->dateTypeList)?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'dateFormatted')->widget(
                DatePicker::className(), [
                    'removeButton' => false,
                    'pluginOptions' => [
                        // 'startView'=>'year',
                        // 'minViewMode'=>'months',
                        'format' => 'dd.mm.yyyy',
                    ]
                ]
            );?>
        </div>
    </div>

    <?= $form->field($model, 'leading_text')->textarea(['rows' => 3, 'maxlength' => true]) ?>

    <div class="row images-wrap">
        <div class="row">
            <div class="col-sm-3">
                <?= $form->field($model, 'imageFile')->fileInput() ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'watermark_type')->dropDownList(Yii::$app->image->watermarkTypesList())->label('Тип водяного знака для шеринга'); ?>
            </div>
        </div>

        <?php foreach ($cropFormArray as $cropForm):?>
            <div class="image-row">
                <?=ImageInput::widget(['cropForm' => $cropForm, 'model' => $model]);?>
            </div>
        <?php endforeach;?>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-sm-5">
                <?= $form->field($model, 'socials_title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'socials_text')->textarea(['rows' => 2, 'maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'twitter_text')->textarea(['rows' => 2, 'maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-8">
                <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
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

    <?= $form->field($model, 'copyright_title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= $form->field($model, 'copyright')->widget(CKEditor::className(), [
            'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                'allowedContent' => true,
                'preset' => 'textEditor'
            ])
        ]);?>
    </div>

    <?=$this->render('_blocks_list', ['blockModelsArray' => $blockModelsArray]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="modal fade docs-cropped" id="viewResult" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="getCroppedCanvasTitle">Результат</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<?php 
$script = "
    $('#event-size').change(function(e) {
        sizesArr = ".json_encode($model->mainPageImageSizes).";
        size = sizesArr[$(this).val()];
        i = $('#sizeRelated').attr('data-i');

        $('#cropform-'+i+'-imagewidth').val(size[0]);
        $('#cropform-'+i+'-imageheight').val(size[1]);

        if(cropper.hasOwnProperty(i) && typeof inputImage !== 'undefined') {
            $('#sizeRelated .crop-modal').modal();
        } else {
            $('#sizeRelated').closest('.image-row').css({'border-color': '#f00'});
        }
    });

    $('#sizeRelated .crop-modal').on('shown.bs.modal', function () {
        $('#sizeRelated').css({'border-color': ''});
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>