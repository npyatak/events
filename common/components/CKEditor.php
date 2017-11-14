<?php
namespace common\components;

use mihaildev\elfinder\ElFinder;
use yii\helpers\ArrayHelper;

Class CKEditor extends \mihaildev\ckeditor\CKEditor {

    public function init()
    {
        $this->editorOptions = [
            ElFinder::ckeditorOptions('elfinder', [
                'preset' => 'full',
                'allowedContent' => true,
            ]),
        ];

        if (array_key_exists('preset', $this->editorOptions)) {
            if($this->editorOptions['preset'] == 'custom'){
                $this->presetCustom();
            }
            unset($this->editorOptions['preset']);
        }
        parent::init();
    }

    private function presetCustom(){
        $options['height'] = 150;

        $options['toolbarGroups'] = [
            ['name' => 'undo'],
            ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
            ['name' => 'colors'],
            ['name' => 'paragraph', 'groups' => ['templates', 'list', 'indent', 'align']],
            //['name' => 'links', 'groups' => ['links', 'insert']],
        ];
        $options['removeButtons'] = 'Subscript,Superscript,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Image,About';
        $options['removePlugins'] = 'elementspath';
        $options['resize_enabled'] = false;

        $this->editorOptions = ArrayHelper::merge($options, $this->editorOptions);
    }
}