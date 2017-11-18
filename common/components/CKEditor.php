<?php
namespace common\components;

use mihaildev\elfinder\ElFinder;
use yii\helpers\ArrayHelper;

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
                
                default:
                    # code...
                    break;
            }
            unset($this->editorOptions['preset']);
        }
        // $this->editorOptions = [
        //     ElFinder::ckeditorOptions('elfinder', [
        //         'preset' => 'custom',
        //         'allowedContent' => true,
        //     ]),
        // ];

        parent::init();
    }

    private function presetTextEditor() {
        /*
            Шрифт
            Размер
            Bold
            Курсив
            Цвет текста
            Цвет фона
            Выравнивание по горизонтали
            Стиль (комбинация параметров)
            Подстрочный индекс
            Надстрочный индекс
            Гиперссылка
            В списке шрифтов должны быть доступны Proxima Nova и PT Serif.
            По умолчанию должен быть выбран шрифт Proxima Nova.
        */

        $options['height'] = 200;

        $options['toolbarGroups'] = [
            ['name' => 'paragraph', 'groups' => ['templates', 'list', 'align']],
            ['name' => 'styles'],
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'colors','cleanup']],
            ['name' => 'links', 'groups' => ['links']],
        ];


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
}