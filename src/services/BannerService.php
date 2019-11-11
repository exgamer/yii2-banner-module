<?php
namespace concepture\yii2banner\services;

use concepture\yii2logic\forms\Form;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\LocalizedReadTrait;


/**
 * Class BannerService
 * @package concepture\yii2banner\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerService extends Service
{
    use StatusTrait;
    use LocalizedReadTrait;

    protected function beforeCreate(Form $form)
    {
        $form->user_id = Yii::$app->user->identity->id;
    }
}
