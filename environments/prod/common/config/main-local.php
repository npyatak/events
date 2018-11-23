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
        'webdavYandex' => [
            'class' => 'creocoder\flysystem\WebDAVFilesystem',
            'baseUri' => 'https://webdav.yandex.ru/',
            'userName' => 'events-test',
            'password' => 'Tass12345',
        ],
        'cdn' => [
            'class' => 'common\components\CDNImages',
            'enabled' => true,
            'domains' => '<cdn.mirrors>',
        ]

        //для яндекса 
        // 'webdavFs' => [
        //     'class' => 'creocoder\flysystem\WebDAVFilesystem',
        //     'baseUri' => 'https://webdav.yandex.ru',
        //     'userName' => 'login',
        //     'password' => 'password',
        // ],
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
        'elfinderYandex' => [
            'class' => 'mihaildev\elfinder\PathController',
            'root' => [
                'class' => 'mihaildev\elfinder\flysystem\Volume',
                'url' => 'https://webdav.yandex.ru/',
                //'path' => '',
                'component' => 'webdavYandex',
            ]
        ]
    ],
];