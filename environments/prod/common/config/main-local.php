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
    ],
];
