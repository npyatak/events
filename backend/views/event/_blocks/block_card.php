<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\blocks\items\BlockCardItem;
?>

<div class="block-card" id="block-card-<?=$i;?>">
    <div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
        <?= Html::activeLabel($model, "[$i]title", ['class' => 'control-label']) ?>
        <?= Html::activeTextInput($model, "[$i]title", ['class' => 'form-control']) ?>
        <?= Html::error($model, "[$i]title", ['class' => 'help-block']);?>
    </div>

    <div class="form-group">
        <?php if(!empty($model->itemsToSave)) {
            $itemModels = $model->itemsToSave;
        } elseif(!empty($model->blockCardItems)) {
            $itemModels = $model->blockCardItems;
        } else {
            $itemModels = [new BlockCardItem];
        }?>

        <div class="card-items">
            <?php foreach ($itemModels as $key => $item) {
                echo $this->render('_block_card_item', ['model' => $item, 'i' => $i, 'key' => $key]);
            } ?>
        </div>

        <?= Html::a('Добавить карточку', '#', ['id' => 'add-card-item', 'class' => 'btn', 'data-i' => $i]) ?>
    </div>
</div>

<?php $script = "
    $(document).on('click', '#add-card-item', function() {
        var i = $(this).data('i');
        var key = $(this).parent().find('.block-card-item').length;

        $.ajax({
            type: 'GET',
            url: '".Url::toRoute(['/event/add-card-item'])."',
            data: 'i='+i+'&key='+key,
            success: function (data) {
                $('#block-card-'+i+' .card-items').append(data);
            }
        });

        return false;
    });

    $(document).on('click', '.remove-card-item', function() {
        $(this).closest('.block-card-item').remove();
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>