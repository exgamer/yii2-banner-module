<?php
namespace concepture\yii2banner\models\traits;

use concepture\yii2banner\models\Banner;

/**
 * Trait BannerTrait
 * @package concepture\yii2user\models\traits
 */
trait BannerTrait
{
    public function getBanner()
    {
        return $this->hasOne(Banner::className(), ['id' => 'banner_id']);
    }

    public function getBannerTitle()
    {
        if (isset($this->banner)){
            return $this->banner->title;
        }

        return null;
    }
}

