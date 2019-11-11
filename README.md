# concepture-yii2banner-module

    
Подключение

"require": {
    "concepture/yii2-banner-module" : "*"
},
    

Миграции
 php yii migrate/up --migrationPath=@concepture/yii2banner/console/migrations
 
Подключение модуля для админки

     'modules' => [
         'banner' => [
             'class' => 'concepture\yii2banner\Module'
         ],
     ],
     
Для переопределния контроллера добавялем в настройки модуля

     'modules' => [
         'banner' => [
            'class' => 'concepture\yii2banner\Module',
            'controllerMap' => [
                'banner' => 'backend\controllers\BannerController'
            ],
         ],
     ],

            
Для переопределния папки с представленяими добавялем в настройки модуля

     'modules' => [
         'banner' => [
             'class' => 'concepture\yii2banner\Module',
             'viewPath' => '@backend/views'
         ],
     ],
     
Для переопределния любого класса можно вооспользоваться инекцией зависимостей через config.php
К примеру подменить модель StaticBlock на свой

    <?php
    return [
        'container' => [
            'definitions' => [
                'concepture\yii2banner\models\StaticBlock' => ['class' => 'backend\models\Banner'],
            ],
        ],
    ]