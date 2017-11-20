<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\blocks\items\BlockGalleryImage;
?>

<div class="block-gallery" id="block-gallery-<?=$i;?>">
    <div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
    	<?= Html::activeLabel($model, "[$i]title", ['class' => 'control-label']) ?>
    	<?= Html::activeTextInput($model, "[$i]title", ['class' => 'form-control']) ?>
    	<?= Html::error($model, "[$i]title", ['class' => 'help-block']);?>
    </div>

    <div class="form-group">
        <?php if(!empty($model->itemsToSave)) {
            $imageModels = $model->itemsToSave;
        } elseif(!empty($model->blockGalleryImages)) {
            $imageModels = $model->blockGalleryImages;
        } else {
            $imageModels = [new BlockGalleryImage];
        }?>
        
        <div class="gallery-images">
            <?php foreach ($imageModels as $key => $slide) {
                echo $this->render('_block_gallery_image', ['model' => $slide, 'i' => $i, 'key' => $key]);
            } ?>
        </div>

        <?= Html::a('Добавить слайд', '#', ['id' => 'add-gallery-image', 'class' => 'btn', 'data-i' => $i]) ?>
    </div>
</div>

<?php $script = "
    $(document).on('click', '#add-gallery-image', function() {
        var i = $(this).data('i');
        var key = $(this).parent().find('.block-gallery-image').length;

        $.ajax({
            type: 'GET',
            url: '".Url::toRoute(['/event/add-gallery-image'])."',
            data: 'i='+i+'&key='+key,
            success: function (data) {
                $('#block-gallery-'+i+' .gallery-images').append(data);
            }
        });

        return false;
    });

    $(document).on('click', '.remove-gallery-image', function() {
        $(this).closest('.block-gallery-image').remove();
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>