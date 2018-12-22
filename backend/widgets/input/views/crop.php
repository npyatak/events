<?php
use yii\helpers\Html;
?>

<?php 
$modelClass = (new \ReflectionClass($model))->getShortName();

$iteration = substr_replace($attribute, '',  strrpos($attribute, ']') - strlen($attribute) + 1);

if($attribute) {
    preg_match_all("/\]/", $attribute, $match);
    if(count($match[0]) > 0) {
        $rawAttribute = substr_replace($attribute, '', 0,  strrpos($attribute, ']') + 1);
        $i = "[$modelClass]".$iteration."[$rawAttribute]";
    } else {
        $i = "[$modelClass][$attribute]";
    }
} else {
    $i = "[$modelClass]".$iteration."[$cropForm->attribute]";
}

$attrString = strtolower(preg_replace(['/\[/', '/\]/'], ['', '-'], $attribute));
if($attrString == '') {
    $attrString = strtolower($cropForm->attribute);
}
?>

<div class="imageWrapper" data-i="<?=strtolower($modelClass).'-'.$attrString;?>" <?=$cropForm->sizeRelated ? 'id="sizeRelated"' : '';?>>
    <div class="crop-header"><?=$header;?> <span>(не менее <?=$cropForm->imageWidth.'&times;'.$cropForm->imageHeight;?>)</span></div>

    <div class="preview" data-image="<?=Yii::$app->image->getImageUrl($model->$previewAttribute);?>">
        <img class="initial-preview" src="<?=Yii::$app->image->getImageUrl($model->$previewAttribute);?>">
    </div>
    <br>
    <div class="controls">
        <a class="showCrop btn btn-default" title="Изменить"><span class="glyphicon glyphicon-pencil"></span></a>
        <a class="showResult btn btn-default" title="Результат"><span class="glyphicon glyphicon-eye-open"></span></a>
        <?php if($deleteButton):?>
            <a class="delete-file btn btn-default" title="Удалить"><span class="glyphicon glyphicon-trash"></span></a>
        <?php endif;?>
    </div>

    <?php if($attribute):?>
        <div class="form-group attribute-input-group <?=$model->hasErrors($attribute) ? 'has-error' : '';?>">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Обзор <?= Html::activeFileInput($model, $attribute, ['class' => 'crop-image-input']) ?>
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
            <?= Html::error($model, $attribute, ['class' => 'help-block']);?>
        </div>
    <?php else:?>
        <div class="form-group attribute-input-group <?=$cropForm->hasErrors("imageFile") ? 'has-error' : '';?>">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-default">
                        Обзор <?= Html::activeFileInput($cropForm, $i."imageFile", ['class' => 'crop-image-input']) ?>
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
            <?= Html::error($cropForm, $i."imageFile", ['class' => 'help-block']);?>
        </div>
    <?php endif;?>

    <div class="modal crop-modal fade docs-cropped" role="dialog" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-11">
                            <h4 class="modal-title"><?=$header;?> - изменить<span></span></h4>
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
                        <img class="image" src="<?=$originImage;?>">
                    </div>
                    <div class="crop-inputs">
                        <div class="sizes-wrap">
                            <?= Html::activeTextInput($cropForm, $i."imageWidth", ['readonly' => true]) ?>
                            &times;
                            <?= Html::activeTextInput($cropForm, $i."imageHeight", ['readonly' => true]) ?>
                        </div>
                        <?= Html::activeHiddenInput($cropForm, $i."attribute") ?>

                        <?= Html::activeLabel($cropForm, $i."x", ['class' => 'control-label']) ?>
                        <?= Html::activeTextInput($cropForm, $i."x", ['class' => 'x', 'readonly' => true]) ?>
                        <?= Html::activeLabel($cropForm, $i."y", ['class' => 'control-label']) ?>
                        <?= Html::activeTextInput($cropForm, $i."y", ['class' => 'y', 'readonly' => true]) ?>
                        <?= Html::activeLabel($cropForm, $i."width", ['class' => 'control-label']) ?>
                        <?= Html::activeTextInput($cropForm, $i."width", ['class' => 'width', 'readonly' => true]) ?>
                        <?= Html::activeLabel($cropForm, $i."height", ['class' => 'control-label']) ?>
                        <?= Html::activeTextInput($cropForm, $i."height", ['class' => 'height', 'readonly' => true]) ?>
                        
                        <div class="preview"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>