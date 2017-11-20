<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Event;

$this->registerJsFile('js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<ul id="blocks">
    <?php if(!empty($blockModelsArray)) {
        foreach ($blockModelsArray as $i => $blockModel) {
            echo $this->render('_blocks/template', ['model' => $blockModel, 'i' => $i]);
        }
    } ?>
</ul>

<hr>

<div class="form-group">
    <?= Html::dropDownList('blocks', '', Event::getBlocksList(), ['id' => 'block-select']) ?>
    <?= Html::a('Добавить блок', '#', ['id' => 'add-block', 'class' => 'btn btn-primary']) ?>
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