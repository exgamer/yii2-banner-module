<?php

namespace concepture\yii2banner\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\localized\Controller;
use concepture\yii2logic\actions\web\StatusChangeLocalizedAction;
use concepture\yii2logic\actions\web\LocalizedAutocompleteListAction;
use concepture\yii2logic\actions\web\UndeleteLocalizedAction;

/**
 * Class StaticBlockController
 * @package concepture\yii2banner\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerController extends Controller
{
    protected function getAccessRules()
    {
        return [
            [
                'actions' => ['index', 'view','create', 'update', 'delete', 'undelete', 'status-change', 'list'],
                'allow' => true,
                'roles' => [UserRoleEnum::ADMIN],
            ]
        ];
    }


    public function actions()
    {
        $actions = parent::actions();

        return array_merge($actions,[
            'status-change' => StatusChangeLocalizedAction::class,
            'list' => LocalizedAutocompleteListAction::class,
            'undelete' => UndeleteLocalizedAction::class,
        ]);
    }
}
