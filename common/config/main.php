<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        /*'cache' => [
            'class' => YII_ENV_DEV ? 'yii\caching\DummyCache' : 'yii\caching\FileCache',
        ],*/
        'cacheBackend' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => Yii::getAlias('@backend') . '/runtime/cache'
        ],
        'cacheFrontend' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => Yii::getAlias('@frontend') . '/runtime/cache'
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/',
            'rules' => [
                '<year:\d+>/event/<alias>' => 'site/event',
            ],
        ],
        'urlManagerBackEnd' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'baseUrl' => '/admin',
        ],     
        'settings' => [
            'class' => 'common\components\Settings',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d.m.Y',
            'datetimeFormat' => 'php:j F, H:i',
            'timeFormat' => 'php:H:i:s',
            'defaultTimeZone' => 'Europe/Moscow',
            'locale' => 'ru-RU'
        ],
        'image' => [
            'class' => 'common\components\ImageHelper',
        ],
    ],

    /*'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            //'access' => ['@'],
            'root' => [
                'baseUrl'=>'',
                'basePath'=>'@frontend/web',
                'path' => 'images',
                'name' => 'Images'
            ]
        ]
    ],*/
];
