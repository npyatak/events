<?php
namespace common\components;

use Yii;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use mihaildev\elfinder\ElFinder;

Class CKEditor extends \mihaildev\ckeditor\CKEditor {

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
            unset($this->editorOptions['preset']);
        }

        parent::init();
    }

    private function presetTextEditor() {
        $options['height'] = 200;

        $options['toolbarGroups'] = [
            ['name' => 'paragraph', 'groups' => ['templates', 'list', 'align']],
            ['name' => 'styles'],
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors','cleanup']],
            ['name' => 'links', 'groups' => ['links', 'insert']],
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