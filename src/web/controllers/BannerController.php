<?php

namespace concepture\yii2banner\web\controllers;

use concepture\yii2user\enum\UserRoleEnum;
use concepture\yii2logic\controllers\web\localized\Controller;
use concepture\yii2logic\actions\web\localized\StatusChangeAction;
use concepture\yii2logic\actions\web\localized\AutocompleteListAction;
use concepture\yii2logic\actions\web\localized\UndeleteAction;
use kamaelkz\yii2cdnuploader\actions\web\ImageDeleteAction;
use kamaelkz\yii2cdnuploader\actions\web\ImageUploadAction;

/**
 * Class BannerController
 * @package concepture\yii2banner\web\controllers
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerController extends Controller
{
    protected function getAccessRules()
    {
        return [
            [
                'actions' => ['index', 'view','create', 'update', 'delete', 'undelete', 'status-change', 'list', 'image-upload', 'image-delete'],
                'allow' => true,
                'roles' => [UserRoleEnum::ADMIN],
            ]
        ];
    }


    public function actions()
    {
        $actions = parent::actions();

        return array_merge($actions,[
            'status-change' => StatusChangeAction::class,
            'list' => AutocompleteListAction::class,
            'undelete' => UndeleteAction::class,
            'image-upload' => ImageUploadAction::class,
            'image-delete' => ImageDeleteAction::class,
        ]);
    }
}
