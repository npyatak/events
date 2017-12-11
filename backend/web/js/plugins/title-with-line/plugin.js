CKEDITOR.plugins.add('TitleWithLine',
{
    onLoad: function() {
        CKEDITOR.addCss(            
            '.grey-line {'+
                'position: relative;'+
                'width: 100%;'+
                'height: 1px;'+
                'background-color: #EBEBEB;'+
            '}'+
            '.grey-line .title {'+
                'position: absolute;'+
                'top: 0;'+
                'left: 0;'+
                'font-size: 14px;'+
                'letter-spacing: 7px;'+
                'color: #535353;'+
                'background-color: #fff;'+
                'padding-right: 30px;'+
                'text-transform: uppercase;'+
                '-webkit-transform: translateY(-50%);'+
                '-moz-transform: translateY(-50%);'+
                '-ms-transform: translateY(-50%);'+
                '-o-transform: translateY(-50%);'+
                'transform: translateY(-50%);'+
            '}'
        );
    },

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