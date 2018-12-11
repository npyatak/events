<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%share}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property EventShare[] $eventCategories
 */
class Share extends \yii\db\ActiveRecord
{
    public $url;
    public $imageFile;
    public $imageFileTw;
    public $imageFileFb;
    public $cropImage = [];
    public $imageCropParams = ['w' => 968, 'h' => 504, 'attribute' => 'image'];
    public $imageTwCropParams = ['w' => 1074, 'h' => 480, 'attribute' => 'image_tw'];
    public $imageFbCropParams = ['w' => 1200, 'h' => 628, 'attribute' => 'image_fb'];

    public $imageNamePrefix;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%share}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'image', 'text', 'twitter'], 'required'],
            [['title', 'text', 'twitter'], 'string', 'max' => 255],
            [['image',  'year_id', 'watermark_type'], 'safe'],
            [['imageFile', 'imageFileTw', 'imageFileFb'], 'file', 'extensions'=>'jpg, png, jpeg, svg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png, image/svg+xml'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'month' => 'Номер месяца',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'twitter' => 'Текст для Twitter',
            'image' => 'Изображение',
            'imageFile' => 'Изображение',
            'imageFileTw' => 'Изображение Twitter',
            'imageFileFb' => 'Изображение Facebook',
            'year_id' => 'Год',
            'watermark_type' => 'Тип водяного знака',
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        $this->imageNamePrefix = $this->id;
   
        $post = Yii::$app->request->post();
        if(isset($post) && isset($post['CropForm']['Share'])) {
            $this->cropImage = $post['CropForm']['Share'];
        }

        if(!empty($this->cropImage)) {
            foreach ($this->cropImage as $fileAttribute => $crop) {
                $this->$fileAttribute = UploadedFile::getInstance($this, $fileAttribute);

                if($this->$fileAttribute) {
                    $type = Yii::$app->image->watermarkTypes()[$this->watermark_type];

                    $exp = explode('.', $type['gradientImage']);
                    $gradientImage = $exp[0].'_'.$crop['imageWidth'].'.'.$exp[1];

                    $watermark = [
                        [
                            'type' => 'image',
                            'image' => $gradientImage,
                            'position' => [0, 0],
                        ],
                        [
                            'type' => 'text',
                            'text' => $this->year->title,
                            'style' => ['size' => 35, 'color' => $type['color']],
                            'position' => [240, 40],
                        ],
                        [
                            'type' => 'image',
                            'image' => $type['logoImage'],
                            'position' => [100, 0],
                        ],
                    ];
                    
                    if(isset($crop)) {
                        Yii::$app->image->updateImageAttribute($this, $crop['attribute'], $this->$fileAttribute, $crop, $watermark);
                    } else {
                        Yii::$app->image->updateImageAttribute($this, $crop['attribute'], $this->$fileAttribute);
                    }
                }
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
    }
}
