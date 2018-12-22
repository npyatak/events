<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=<mysql.hostname>:<mysql.port>;dbname=<mysql.database>',
            'username' => '<mysql.username>',
            'password' => '<mysql.password>',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],        
        'memCache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => '<memcached.host>',
                    'port' => '<memcached.port>',
                ],
            ],
        ],
        'webdavFs' => [
            'class' => 'creocoder\flysystem\WebDAVFilesystem',
            'baseUri' => '<cdn.host>',
            'userName' => '<cdn.user>',
            'password' => '<cdn.password>',
        ],
        'cdn' => [
            'class' => 'common\components\CDN',
            'enabled' => true,
            'domains' => '<cdn.mirrors>',
        ],
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'root' => [
                'class' => 'mihaildev\elfinder\flysystem\Volume',
                'url' => '<cdn.host>',
                'path' => 'events/images',
                'component' => 'webdavFs',
            ]
        ],
    ],
];