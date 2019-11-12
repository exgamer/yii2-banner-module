<?php

namespace concepture\yii2banner\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\Controller;


/**
 * Class StaticBlockController
 * @package concepture\yii2banner\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerUrlLinkController extends Controller
{
    protected function getAccessRules()
    {
        return [
            [
                'actions' => ['index', 'view','create', 'update', 'delete'],
                'allow' => true,
                'roles' => [UserRoleEnum::ADMIN],
            ]
        ];
    }
}
