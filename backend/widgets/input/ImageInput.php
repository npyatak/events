<?php
namespace backend\widgets\input;

use Yii;
use yii\helpers\Html;
use common\components\ImageHelper;

use backend\models\forms\CropForm;

class ImageInput extends \yii\base\Widget 
{
	public $model;
    public $attribute = false;
    public $previewAttribute;
	public $cropForm = false;
	public $cropParams = [];
    public $deleteButton = false;

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
                'originImage' => $this->getOrigin(),
                'deleteButton' => $this->deleteButton,
            ]);
        } else {
            return $this->getView()->renderFile(__DIR__ . '/views/image.php', [
                'model' => $this->model, 
                'attribute' => $this->attribute,
                'previewAttribute' => $this->previewAttribute,
                'header' => $header,
                'originImage' => $this->getOrigin(),
                'deleteButton' => $this->deleteButton,
            ]);
        }

    }

    public function getOrigin()
    {
        return false;
        /*$path =  ImageHelper::PATH_ROOT;
        $modelClass = (new \ReflectionClass($this->model))->getShortName();
        $originFileName = false;
        
        $previewAttribute = $this->previewAttribute;
        if($this->model->$previewAttribute) {
            $exp = explode('.', $this->model->$previewAttribute);
            $extension = explode('?', $exp[1])[0];
            
            if($modelClass == 'Event') {
                $fileName = '/uploads/'.$this->model->id.'_origin_'.$this->cropForm->attribute.'.'.$extension;
                if(isset(Yii::$app->webdavFs) && Yii::$app->webdavFs->has('/events'.$fileName)) {
                    echo 1;
                    return $fileName;
                } elseif(file_exists($path.$originFileName)) {
                    echo 2;
                    return $fileName;
                } else {
                    echo 3;
                    return $this->model->origin_image;
                }
            } else {

            }
        }*/
    }

    private function registerAssets()
    {
        $asset = AlertAsset::register($this->getView());
    }
}