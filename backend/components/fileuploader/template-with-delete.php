<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-new thumbnail" style="width: 200px; height: 100px;">
        <?=$thumbnail;?>
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 100px;"></div>
    <div>
        <span class="btn btn-default btn-file btn-block">
            <span class="fileinput-new">Выбрать</span>
            <span class="fileinput-exists">Изменить</span>
            <?=$field;?>
        </span>
        <a href="#" class="btn btn-default btn-block fileinput-exists" data-dismiss="fileinput">
            Удалить
        </a>
        <a href="#" class="btn btn-danger btn-block delete-file">
            Оставить пустым
        </a>
    </div>
</div>

<?php
$script = "
    $(document).on('click', '.delete-file', function(e) {
        $(this).closest('.fileinput').find('input[type=\"hidden\"]').val('delete');
        $(this).closest('.fileinput').find('.thumbnail').html('');

        return false;
    });
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>