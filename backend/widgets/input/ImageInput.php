<?php
namespace backend\widgets\input;

use Yii;
use yii\helpers\Html;

use backend\models\forms\CropForm;

class ImageInput extends \yii\base\Widget 
{
	public $model;
    public $attribute = false;
    public $previewAttribute;
	public $cropForm = false;
	public $cropParams = [];

    public function init()
    {
        //$this->registerAssets();
    }

    public function run()
    {
        $modelClass = (new \ReflectionClass($this->model))->getShortName();
        $header = '';
        
        if($this->attribute) {
            if(substr_count($this->attribute, ']') > 0) {
                $rawAttribute = substr_replace($this->attribute, '', 0,  strrpos($this->attribute, ']') + 1);
            } else {
                $rawAttribute = $this->attribute;
            }
            
            if(isset($this->model->attributeLabels()[$rawAttribute])) {
                $header = $this->model->attributeLabels()[$rawAttribute];
            }
    	}

        if(!$this->cropForm && !empty($this->cropParams)) {
            $cropForm = new CropForm;
            $cropForm->imageWidth = $this->cropParams['w'];
            $cropForm->imageHeight = $this->cropParams['h'];
            $cropForm->attribute = $this->cropParams['attribute'];
            
            if(isset($this->cropParams['header'])) {
                $header = $this->cropParams['header'];
            }
            
            $this->cropForm = $cropForm;
        }

        if($this->cropForm) {
            $this->previewAttribute = $this->cropForm->attribute;
            return $this->getView()->renderFile(__DIR__ . '/views/crop.php', [
                'model' => $this->model, 
                'attribute' => $this->attribute,
                'previewAttribute' => $this->previewAttribute,
                'cropForm' => $this->cropForm, 
                'header' => $header ? $header : $this->cropForm->header,
            ]);
        } else {
            return $this->getView()->renderFile(__DIR__ . '/views/image.php', [
                'model' => $this->model, 
                'attribute' => $this->attribute,
                'previewAttribute' => $this->previewAttribute,
                'header' => $header,
            ]);
        }

    }

    private function registerAssets()
    {
        $asset = AlertAsset::register($this->getView());
    }
}