<?php
use yii\helpers\Html;
?>

<?php 
$modelClass = (new \ReflectionClass($model))->getShortName();
$attrString = strtolower(preg_replace(['/\[/', '/\]/'], ['', '-'], $attribute));
?>

<div class="imageWrapper" data-i="<?=strtolower($modelClass).'-'.$attrString;?>">
    <div class="crop-header"><?=$header;?></div>

    <div class="preview" data-image="<?=Yii::$app->image->getImageUrl($model->$previewAttribute);?>">
        <img class="initial-preview" src="<?=Yii::$app->image->getImageUrl($model->$previewAttribute);?>">
    </div>
    <br>

    <div class="form-group <?=$model->hasErrors($attribute) ? 'has-error' : '';?>">
        <?= Html::activeFileInput($model, $attribute, ['class' => 'crop-image-input']) ?>
        <?= Html::error($model, $attribute, ['class' => 'help-block']);?>
    </div>
</div>