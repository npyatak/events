<?php
namespace common\components;

use Yii;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use mihaildev\elfinder\ElFinder;

Class CKEditor extends \sadovojav\ckeditor\CKEditor {

    public function init()
    {
        if (array_key_exists('preset', $this->editorOptions)) {
            switch ($this->editorOptions['preset']) {
                case 'textEditor':
                    $this->presetTextEditor();
                    break;
                case 'linkOnly':
                    $this->presetLinkOnly();
                    break;
                case 'colorAndAlign':
                    $this->presetColorAndAlign();
                    break;
                case 'iFrameOnly':
                    $this->presetIFrameOnly();
                    break;
            }
        }
        $this->editorOptions['language'] = 'ru';

        parent::init();
    }

    private function presetTextEditor() {
        $options['height'] = 200;
        
        $this->extraPlugins = [
            ['BlueHr', '@backend/web/js/plugins/blue-hr/', 'plugin.js'],
            ['TitleWithLine', '@backend/web/js/plugins/title-with-line/', 'plugin.js']
        ];
        $options['extraPlugins'] = 'BlueHr,TitleWithLine,image2';

        $options['toolbar'] = [
            ['Format', 'FontSize', 'Font'],
            ['Bold', 'Italic', 'Underline', 'TextColor', 'StrikeThrough', 'HorizontalRule', 'BlueHr', 'TitleWithLine'],
            ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Image', 'Video', 'Iframe', 'Table', 'SpecialChar'],
            ['Link', 'Unlink'],
        ];

        $options['contentsCss'] = Yii::$app->urlManagerBackEnd->createUrl(['css/fonts.css']);
        $options['font_names'] = 'ProximaNova/ProximaNova-Regular;PTSerif/PTSerifItalic;Arial/Arial';

        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }

    private function presetLinkOnly() {
        /*
            Гиперссылка
        */
        $options['height'] = 100;

        $options['toolbarGroups'] = [
            ['name' => 'links', 'groups' => ['links']],
        ];


        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }

    private function presetColorAndAlign() {
        /*
            Только выбор цвета и выравнивание
        */
        $options['height'] = 100;

        $options['toolbarGroups'] = [
            ['name' => 'basicstyles', 'groups' => ['align', 'colors']],
        ];


        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }

    private function presetIFrameOnly() {
        /*
            Только выбор цвета и выравнивание
        */
        $options['height'] = 100;

        $options['toolbar'] = [
            ['name' => 'links', 'items' => ['Iframe']],
        ];


        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }
}