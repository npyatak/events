<?php
use yii\helpers\Url;
use yii\helpers\Html;

use common\models\blocks\items\BlockFactItem;
?>

<div class="block-fact" id="block-fact-<?=$i;?>">
    <div class="form-group <?=$model->hasErrors("title") ? 'has-error' : '';?>">
        <?= Html::activeLabel($model, "[$i]title", ['class' => 'control-label']) ?>
        <?= Html::activeTextInput($model, "[$i]title", ['class' => 'form-control']) ?>
        <?= Html::error($model, "[$i]title", ['class' => 'help-block']);?>
    </div>

    <div class="form-group">
        <?php if(!empty($model->itemsToSave)) {
            $itemModels = $model->itemsToSave;
        } elseif(!empty($model->blockFactItems)) {
            $itemModels = $model->blockFactItems;
        } else {
            $itemModels = [new BlockFactItem];
        }?>
        
        <div class="fact-items">
            <?php foreach ($itemModels as $key => $item) {
                echo $this->render('_block_fact_item', ['model' => $item, 'i' => $i, 'key' => $key]);
            } ?>
        </div>

        <?= Html::a('Добавить факт', '#', ['id' => 'add-fact-item', 'class' => 'btn', 'data-i' => $i]) ?>
    </div>
</div>

<?php $script = "
    $(document).on('click', '#add-fact-item', function() {
        var i = $(this).data('i');
        var key = $(this).parent().find('.block-fact-item').length;

        $.ajax({
            type: 'GET',
            url: '".Url::toRoute(['/event/add-fact-item'])."',
            data: 'i='+i+'&key='+key,
            success: function (data) {
                $('#block-fact-'+i+' .fact-items').append(data);
            }
        });

        return false;
    });

    $(document).on('click', '.remove-fact-item', function() {
        $(this).closest('.block-fact-item').remove();
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>