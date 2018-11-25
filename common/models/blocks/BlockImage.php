<?php

namespace common\models\blocks;

use Yii;
use yii\web\UploadedFile;

class BlockImage extends Block
{
    public $imageFile;

    public static function tableName()
    {
        return '{{%block_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), 
            [
                //[['source'], 'required'],
                [['show_fullscreen'], 'integer'],
                [['source', 'copyright_text', 'text'], 'string', 'max' => 255],
                [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            ]
        );
    }

    public static function getBlockName() {
        return 'Изображение';
    }

    public function afterSave($insert, $changedAttributes) {
            $this->imageFile = UploadedFile::getInstance($this, "[$this->key]imageFile");
        print_r($this);exit;
        //print_r($changedAttributes);exit;
        if(!isset($changedAttributes['source'])) {
            $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
            if($this->imageFile) {
                $root = __DIR__ . '/../../frontend/web';
                $path = '/uploads/';
                if(!file_exists($root.$path)) {
                    mkdir($root.$path, 0775, true);
                }

                $this->source = $path.$this->event_id.'block_image_'.$this->id.'.'.$this->imageFile->extension;
                $this->save(false, ['source']);

                $this->imageFile->saveAs($root.$this->source);

                if(isset(Yii::$app->webdavFs)) {                    
                    $content = file_get_contents($root.$this->source);
                    unlink($root.$this->source);

                    Yii::$app->webdavFs->put('events/'.$this->source, $content);
                }
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
                'source' => 'Источник',
                'show_fullscreen' => 'На весь экран',
                'copyright_text' => 'Текст копирайта',
                'text' => 'Сопровождающий текст',
            ]
        );
    }
}