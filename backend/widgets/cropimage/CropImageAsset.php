<?php

namespace backend\widgets\cropimage;

use yii\web\AssetBundle;

class CropImageAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/cropper.css',
    ];
    public $js = [
        'js/cropper.js',
        //'js/script.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
