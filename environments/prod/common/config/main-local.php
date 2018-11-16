<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=<mysql.hostname>;port=<mysql.port>;dbname=<mysql.database>',
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
                'path' => 'images',
                'component' => 'webdavFs',
            ]
        ]
    ],
        //для яндекса 
    // 'controllerMap' => [
    //     'elfinder' => [
    //         'class' => 'mihaildev\elfinder\PathController',
    //         'root' => [
    //             'class' => 'mihaildev\elfinder\flysystem\Volume',
    //             'url' => 'https://webdav.yandex.ru/',
    //             'path' => 'any_folder_or_empty',
    //             'component' => 'webdavFs',
    //         ]
    //     ]
    // ],
];