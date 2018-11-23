<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;

class EventImagesForm extends Model
{
    public $image;
    public $imageFile;
    public $imageWidth;
    public $imageHeight;
    public $x;
    public $y;
    public $width;
    public $height;
    public $scaleX;
    public $scaleY;
    public $sizeRelated = false;

    public $header;
    public $eventAttribute;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageWidth', 'imageHeight', 'x', 'y', 'width', 'height', 'eventAttribute', 'imageFile'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'x' => 'X выбранной области',
            'y' => 'Y выбранной области',
            'width' => 'Ширина выбранной области',
            'height' => 'Высота выбранной области',
            'imageFile' => 'Изображение',
        ];
    }
}
