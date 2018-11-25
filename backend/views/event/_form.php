<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use common\components\ElfinderInput;
use common\components\CKEditor;

use common\models\Event;

\backend\widgets\cropimage\CropImageAsset::register($this);
?>

<div class="district-form">

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
    <!-- </div> -->

    <?= $form->field($model, 'leading_text')->textarea(['rows' => 3]) ?>

    <div class="images-wrap">
        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <?php foreach ($eventImagesFormArray as $i => $imageForm):?>
            <?php $attribute = $imageForm->eventAttribute;?>
            <div class="image-row" data-i="<?=$i;?>" <?=$imageForm->sizeRelated ? 'id="sizeRelated"' : '';?>>
                <div class="header"><?=$imageForm->header;?></div>

                <div class="preview" data-image="<?=$model->getImageUrl($model->$attribute);?>">
                    <img class="initial-preview" src="<?=$model->getImageUrl($model->$attribute);?>">
                </div>
                <br>
                <div class="controls">
                    <a class="showCrop btn btn-default" title="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a class="showResult btn btn-default" title="Результат"><span class="glyphicon glyphicon-eye-open"></span></a>
                </div>

                <?= $form->field($imageForm, "[$i]imageFile", ['options' => ['class' => 'form-group attribute-input-group']])->fileInput(['class' => 'attributeInput'])->label(false) ?>

                <div class="modal crop-modal fade docs-cropped" role="dialog" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="row">
                                    <div class="col-sm-11">
                                        <h4 class="modal-title"><?=$imageForm->header;?> - изменить</h4>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="crop-wrap">
                                    <img class="image" id="image<?=$i;?>" src="">
                                </div>
                                <div class="crop-inputs">
                                    <div class="sizes-wrap">
                                        <?= Html::activeTextInput($imageForm, "[$i]imageWidth", ['readonly' => true]) ?>
                                        &times;
                                        <?= Html::activeTextInput($imageForm, "[$i]imageHeight", ['readonly' => true]) ?>
                                    </div>
                                    <?= Html::activeHiddenInput($imageForm, "[$i]eventAttribute") ?>


                                    <?= Html::activeLabel($imageForm, "[$i]x", ['class' => 'control-label']) ?>
                                    <?= Html::activeTextInput($imageForm, "[$i]x", ['class' => 'x', 'readonly' => true]) ?>
                                    <?= Html::activeLabel($imageForm, "[$i]y", ['class' => 'control-label']) ?>
                                    <?= Html::activeTextInput($imageForm, "[$i]y", ['class' => 'y', 'readonly' => true]) ?>
                                    <?= Html::activeLabel($imageForm, "[$i]width", ['class' => 'control-label']) ?>
                                    <?= Html::activeTextInput($imageForm, "[$i]width", ['class' => 'width', 'readonly' => true]) ?>
                                    <?= Html::activeLabel($imageForm, "[$i]height", ['class' => 'control-label']) ?>
                                    <?= Html::activeTextInput($imageForm, "[$i]height", ['class' => 'height', 'readonly' => true]) ?>
                                    <?//= Html::activeTextInput($imageForm, "[$i]scaleX", ['class' => 'scaleX', 'readonly' => true]) ?>
                                    <?//= Html::activeTextInput($imageForm, "[$i]scaleY", ['class' => 'scaleY', 'readonly' => true]) ?>
                                    
                                    <div class="preview" id="preview<?=$i;?>"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php endforeach;?>
    </div>


    <!-- <div class="row">
        <div class="col-sm-6">
            <?=$form->field($model, 'main_page_image_url')->widget(ElfinderInput::className());?>
        </div>
        <div class="col-sm-6">
            <?=$form->field($model, 'mobile_image_url')->widget(ElfinderInput::className());?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'image_url')->widget(ElfinderInput::className());?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'small_image_url')->widget(ElfinderInput::className());?>
        </div>
    </div> -->

    <div class="form-group">
        <!-- <div class="row">
            <!-- <div class="col-sm-6">
                <?= $form->field($model, 'socials_title')->textInput() ?>
            </div> -->

            <!-- <div class="col-sm-6">
                <?= $form->field($model, 'socials_image_url')->widget(ElfinderInput::className());?>
            </div>
        </div> -->

        <div class="row">
            <div class="col-sm-5">
                <?= $form->field($model, 'socials_title')->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'socials_text')->textarea(['rows' => 2]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'twitter_text')->textarea(['rows' => 2]) ?>
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
    var inputImage;
    var images = [];
    var cropper = [];

    function initCropper(i) {
        var image = $('.image-row[data-i=\"'+i+'\"]').find('.image');
        var preview = $('.image-row[data-i=\"'+i+'\"]').find('.preview');

        if(cropper.hasOwnProperty(i)) {
            image.cropper('destroy');
        }

        var containerWidth = inputImage.width;
        var containerHeight = inputImage.height;
        if(inputImage.width > $('.crop-modal .crop-wrap').width()) {
            containerWidth = $('.crop-modal .crop-wrap').width();
            containerHeight = containerWidth * inputImage.height / inputImage.width;
        }

        height = image.height() + 4;
        preview.css({ 
            width: '100%', //width,  sets the starting size to the same as orig image  
            overflow: 'hidden',
            height:    height,
            //maxWidth:  image.width(),
            //maxHeight: height
        });

        image.cropper({
            preview: preview,
            viewMode: 1,
            dragMode: 'move',
            minContainerWidth: containerWidth,
            minContainerHeight: containerHeight,
            aspectRatio: $('#eventimagesform-'+i+'-imagewidth').val() / $('#eventimagesform-'+i+'-imageheight').val(),
            crop: function(event) {
                $(event.target).closest('.image-row').find('.x').val(event.detail.x);
                $(event.target).closest('.image-row').find('.y').val(event.detail.y);
                $(event.target).closest('.image-row').find('.width').val(event.detail.width);
                $(event.target).closest('.image-row').find('.height').val(event.detail.height);
                console.log(event);
            },
            ready: function(event) {
                console.log('ready');
            }
        });

        cropper[i] = image.data('cropper');
    }


    $('.showResult').click(function(e) {
        i = $(this).closest('.image-row').attr('data-i');

        if(cropper.hasOwnProperty(i)) {
            var result = cropper[i].getCroppedCanvas({width: $('#eventimagesform-'+i+'-imagewidth').val(), height: $('#eventimagesform-'+i+'-imageheight').val()})
            $('#viewResult').modal().find('.modal-body').html(result);
        } else {
            src = $(this).closest('.image-row').find('.preview').attr('data-image');
            $('#viewResult').modal().find('.modal-body').html('<img src=\"'+src+'\">');
        }

        return false;
    });

    $('#viewResult').on('shown.bs.modal', function () {
        $('#viewResult .modal-dialog').css({width: $('#viewResult .modal-body img').width() + 30});
    });

    $('.showCrop').click(function(e) {
        $(this).closest('.image-row').find('.crop-modal').modal().find('.modal-title span').html($(this).closest('.image-row').find('.header').html());

        return false;
    });

    $('.crop-modal').on('shown.bs.modal', function () {
        var i = $(this).closest('.image-row').attr('data-i');
        initCropper(i);
    });

    $('#event-imagefile').change(function(e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                inputImage = new Image;
                inputImage.src = reader.result;

                $('.image').attr('src', reader.result);

                inputImage.onload = function() {
                    $('.crop-modal').modal();
                }
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('.attributeInput').change(function(e) {
        if (this.files && this.files[0]) {
            var i = $(this).closest('.image-row').attr('data-i');
            var reader = new FileReader();

            reader.onload = function (e) {
                inputImage = new Image;
                inputImage.src = reader.result;

                $('#image'+i).attr('src', reader.result);

                inputImage.onload = function() {
                    $('.image-row[data-i=\"'+i+'\"]').find('.crop-modal').modal();
                }
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#event-size').change(function(e) {
        sizesArr = ".json_encode($model->mainPageSizes).";
        size = sizesArr[$(this).val()];
        console.log(size[0]);
        i = $('#sizeRelated').attr('data-i');

        $('#eventimagesform-'+i+'-imagewidth').val(size[0]);
        $('#eventimagesform-'+i+'-imageheight').val(size[1]);

        if(cropper.hasOwnProperty(i) && typeof inputImage !== 'undefined') {
            $('#sizeRelated .crop-modal').modal();
        }
        
    })
";

$this->registerJs($script, yii\web\View::POS_END);?>