<?php

namespace backend\widgets\cropimage;

use yii\web\AssetBundle;

class CropImageAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/font-awesome.min.css',
        'css/cropper.css',
    ];
    public $js = [
        'js/jquery-cropper.js',
        'js/main.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
