<?php

return [
    'id'        => 'yii2-user-test',
    'basePath'  => dirname(__DIR__),
    'bootstrap' => [
        'mii\modules\users\Bootstrap'
    ],
    'extensions' => require(VENDOR_DIR . '/yiisoft/extensions.php'),
    'aliases' => [
        '@dektrium/user' => realpath(__DIR__. '/../../../../'),
        '@vendor'        => VENDOR_DIR,
        '@bower'         => VENDOR_DIR . '/bower',
    ],
    'modules' => [
        'users' => [
            'class' => 'mii\modules\users\Module',
            'admins' => ['user'],
            'mailer' => [
                'class' => 'mii\MailerMock',
            ],
        ]
    ],
    'components' => [
        'assetManager' => [
            'basePath' => '@tests/codeception/app/assets'
        ],
        'log'   => null,
        'cache' => null,
        'request' => [
            'enableCsrfValidation'   => false,
            'enableCookieValidation' => false
        ],
        'db' => require __DIR__ . '/db.php',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true
        ],
    ],
];
