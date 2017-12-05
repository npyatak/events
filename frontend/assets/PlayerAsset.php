<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class PlayerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/player/jwplayer.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
