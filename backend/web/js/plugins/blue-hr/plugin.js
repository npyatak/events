CKEDITOR.plugins.add('BlueHr',
{
    init: function (editor) {
        var pluginName = 'BlueHr';
        editor.ui.addButton('BlueHr',
            {
                label: 'Синий разделитель',
                command: 'insertHR',
                icon: CKEDITOR.plugins.getPath('pagebreak') + 'images/pagebreak.gif'
            });
        var cmd = editor.addCommand('insertHR', { exec: insertHR });
    }
});
function insertHR(e) {
   e.insertHtml('<hr class="blue">');
}