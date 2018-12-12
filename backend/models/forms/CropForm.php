<?php
namespace backend\models\forms;

use Yii;
use yii\base\Model;

class CropForm extends Model
{
    public $postPath;
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
    public $watermark = false;

    public $header;
    public $attribute;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageWidth', 'imageHeight', 'x', 'y', 'width', 'height', 'attribute', 'imageFile', 'watermark'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg, svg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png, image/svg+xml'],
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
