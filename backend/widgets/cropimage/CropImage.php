<?php
namespace backend\widgets\cropimage;

use Yii;
use yii\helpers\Html;

class CropImage extends \yii\base\Widget 
{

    public function init()
    {
        $this->registerAssets();
    }


    private function registerAssets()
    {
        $asset = AlertAsset::register($this->getView());
    }
}