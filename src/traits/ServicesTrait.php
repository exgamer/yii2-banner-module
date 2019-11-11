<?php
namespace concepture\yii2banner\traits;

use concepture\yii2banner\services\BannerService;
use Yii;

/**
 * Trait ServicesTrait
 * @package concepture\yii2banner\traits
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
trait ServicesTrait
{
    /**
     * @return BannerService
     */
    public function bannerService()
    {
        return Yii::$app->bannerService;
    }
}

