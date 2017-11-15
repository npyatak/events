<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use common\components\CKEditor;

use common\models\Event;

$this->registerJsFile('/js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
        <div class="col-sm-6">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'view_date')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'timelineDateFormatted')->widget(
                DatePicker::className(), [
                    'pluginOptions' => [
                        'startView'=>'year',
                        'minViewMode'=>'months',
                        'format' => 'mm.yyyy',
                    ]
                ]
            )->label($model->attributeLabels()['timeline_date']);?>
        </div>
    </div>

    <?= $form->field($model, 'leading_text')->textarea(['rows' => 3]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'socials_image_url')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'image_url')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'socials_text')->textarea(['rows' => 3]) ?>

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

    <?= $form->field($model, 'content')->widget(CKEditor::classname());?>

    <ul id="blocks">
        <?php if(!empty($blockModelsArray)) {
            foreach ($blockModelsArray as $i => $blockModel) {
                echo $this->render('_blocks/template', ['model' => $blockModel, 'i' => $i]);
            }
        } ?>
    </ul>

    <hr>

    <div class="form-group">
	    <?= Html::dropDownList('blocks', '', $model->blocksArray, ['id' => 'block-select']) ?>
	    <?= Html::a('Добавить блок', '#', ['id' => 'add-block', 'class' => 'btn btn-primary']) ?>
	</div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php $script = "
    $(document).on('click', '#add-block', function() {
        var blockClass = $('#block-select').find(':selected').val();
        var i = $('#blocks .block').length;

        $.ajax({
            type: 'GET',
            url: '".Url::toRoute(['/event/add-block'])."',
            data: 'blockClass='+blockClass+'&i='+i,
            success: function (data) {
            	$('#blocks').append(data);
                updateBlocksOrder();
            }
        });

        return false;
    });

    $(document).on('click', '.block .remove', function() {
    	$(this).closest('.block').remove();
        updateBlocksOrder();
    });

    $('#blocks').sortable({
        cursor: 'move',  
        classes: {
            'ui-sortable': 'highlight'
        },
        update: function(event, ui) {
            updateBlocksOrder();
        }
    });

    function updateBlocksOrder() {
        $('.block').each(function() {
            var order = $(this).index() + 1;
            $(this).find('.hidden-order').val(order);
        });
    }
";

$this->registerJs($script, yii\web\View::POS_END);?>