<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' =>
        [
            'log',
            'common\bootstrap\SetUp',
        ],
    'modules' => [
        'yii2images' => [
        'class' => 'backend\images\Module',
        //be sure, that permissions ok
        //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
        'imagesStorePath' => 'images/store', //path to origin images
        'imagesCachePath' => 'images/cache', //path to resized copies
        'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
        'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        'imageCompressionQuality' => 100, // Optional. Default value is 85.
    ],
        ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'clinics/index'
            ],
        ],
        'imageFactory' => [
            'class' => backend\images\ImageFactory::class,
            'storage' => 'google'
        ],
        's3bucket' => [
            'class' => \CTala\Storage::className(),
            'region' => 'us-east-2',
            'credentials' => [ // Aws\Credentials\CredentialsInterface|array|callable
                'key' => '',
                'secret' => '',
            ],
            'bucket' => 'bookimed',
            //'cdnHostname' => 'https://s3.console.aws.amazon.com/s3/buckets/bookimed/?region=us-east-2&tab=overview',
            'defaultAcl' => \CTala\Storage::ACL_PUBLIC_READ,
            'debug' => false, // bool|array
        ],


        'awss3Fs' => [
            'class' => 'creocoder\flysystem\AwsS3Filesystem',
            'key' => '',
            'secret' => '',
            'bucket' => 'bookimed',
            'region' => 'us-east-2',
            // 'version' => 'latest',
            // 'baseUrl' => 'your-base-url',
            // 'prefix' => 'your-prefix',
            // 'options' => [],
            // 'endpoint' => 'http://my-custom-url'
        ],


    ],
    'params' => $params,
];
