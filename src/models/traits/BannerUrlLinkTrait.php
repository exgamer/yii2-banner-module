<?php
namespace concepture\yii2banner\models\traits;

use concepture\yii2banner\models\BannerUrlLink;

/**
 * Trait BannerUrlLinkTrait
 * @package concepture\yii2banner\models\traits
 */
trait BannerUrlLinkTrait
{
    public function getUrlLinks()
    {
        return $this->hasMany(BannerUrlLink::className(), ['banner_id' => 'id'])->alias('u');
    }
}

