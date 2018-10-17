<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Event;

\backend\assets\UIAsset::register($this);
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
    window.ckeConfigs = [];

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
        handle: '.header',
        classes: {
            'ui-sortable': 'highlight'
        },
        update: function(event, ui) {
            updateBlocksOrder();
        },
        start: function(event, ui) {
            var textareas = ui.item.find('textarea');
            $(textareas).each(function() {
                var id = $(this).attr('id');
                if (typeof id != 'undefined') {
                    var editorInstance = CKEDITOR.instances[id];
                    window.ckeConfigs[id] = editorInstance.config;
                    editorInstance.destroy();
                    CKEDITOR.remove(id);
                }
            });
        },
        stop: function(event, ui) {
            var textareas = ui.item.find('textarea');
            $(textareas).each(function() {
                var id = $(this).attr('id');
                if (typeof id != 'undefined') {
                    CKEDITOR.replace(id, window.ckeConfigs[id]);
                }
            });
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