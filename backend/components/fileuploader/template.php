<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-new thumbnail">
        <?=$thumbnail;?>
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 100px;"></div>
    <div class="fileinput-controls">
        <span class="btn btn-default btn-file">
            <span class="fileinput-new">Выбрать</span>
            <span class="fileinput-exists">Изменить</span>
            <?=$field;?>
        </span>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
            Удалить
        </a>
    </div>
</div>