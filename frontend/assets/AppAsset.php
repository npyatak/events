<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/icons.css?v=27122017_1',
        'css/bootstrap.min.css',
        'css/owl.carousel.min.css',
        'css/owl.theme.default.min.css',
        'css/core.css?v=10.01.2019',
        'css/main.css?v=10.01.2019',
    ];
    public $js = [
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/masonry.pkgd.min.js',
        'js/owl.carousel.min.js',
        'js/main.js?v=01.02.2019',
        'js/jquery.lazyload.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
