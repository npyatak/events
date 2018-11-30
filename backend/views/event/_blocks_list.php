<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Event;

//\backend\assets\UIAsset::register($this);
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

    /*$('#blocks').sortable({
        cursor: 'move',
        handle: '.header',
        classes: {
            'ui-sortable': 'highlight'
        },
        update: function(event, ui) {
            updateBlocksOrder();
        },
        start: function(event, ui) {
            saveTextareas(ui.item.find('textarea'));
        },
        stop: function(event, ui) {
            loadTextareas(ui.item.find('textarea'))
        }
    });*/

    $(document).on('click', '.block .move-up', function(e) {
        e.defaultPrevented;
        var block = $(this).closest('.block');
        if(block.find('.hidden-order').val() == 1) {
            return false;
        }
        var textareas = block.find('textarea');
        saveTextareas(textareas);

        block.insertBefore(block.prev());
        
        loadTextareas(textareas);

        updateBlocksOrder();
        
        $('html, body').animate({
            scrollTop: block.offset().top - 50
        }, 500);

        return false;
    });

    $(document).on('click', '.block .move-down', function() {
        var block = $(this).closest('.block');
        if(block.find('.hidden-order').val() == $('.block').length) {
            return false;
        }
        var textareas = block.find('textarea');
        saveTextareas(textareas);

        block.insertAfter(block.next());
        
        loadTextareas(textareas);

        updateBlocksOrder();
        
        $('html, body').animate({
            scrollTop: block.offset().top - 50
        }, 500);

        return false;
    });

    function saveTextareas(textareas) {
        $(textareas).each(function() {
            var id = $(this).attr('id');
            if (typeof id != 'undefined') {
                var editorInstance = CKEDITOR.instances[id];
                window.ckeConfigs[id] = editorInstance.config;
                editorInstance.destroy();
                CKEDITOR.remove(id);
            }
        });
    }

    function loadTextareas(textareas) {
        $(textareas).each(function() {
            var id = $(this).attr('id');
            if (typeof id != 'undefined') {
                CKEDITOR.replace(id, window.ckeConfigs[id]);
            }
        });
    }

    function updateBlocksOrder() {
        for (var order = 1; order <= $('.block').length; order++) {
            index = order - 1;
            $('.block:eq('+index+')').find('.hidden-order').val(order);
            $('.block:eq('+index+')').find('.order-number').html(order);
        }
    }
";

$this->registerJs($script, yii\web\View::POS_END);?>