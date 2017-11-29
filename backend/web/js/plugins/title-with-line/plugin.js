CKEDITOR.plugins.add('TitleWithLine',
{
    init: function (editor) {
        var pluginName = 'TitleWithLine';
        editor.ui.addButton('TitleWithLine',
            {
                label: 'Заголовок с серой отсечкой',
                command: 'insertTitle',
                icon: CKEDITOR.plugins.getPath('pagebreak') + 'images/pagebreak.gif'
            });
        var cmd = editor.addCommand('insertTitle', { exec: insertTitle });
    }
});
function insertTitle(e) {
    var title = prompt('Введите заголовок', '');
    if(title.length > 0) {
        e.insertHtml('<div class="grey-line"><div class="title">'+title+'</div></div>');
    }
}