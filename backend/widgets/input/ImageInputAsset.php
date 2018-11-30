<?php

namespace backend\widgets\input;

use yii\web\AssetBundle;

class ImageInputAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/cropper.css',
    ];
    public $js = [
        'js/cropper.min.js',
        'js/crop.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
