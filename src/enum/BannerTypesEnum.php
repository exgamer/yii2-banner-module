<?php

namespace concepture\yii2banner\enum;

use Yii;
use concepture\yii2logic\enum\Enum;

class BannerTypesEnum extends Enum
{
    const IMAGE = 0;
    const HTML = 1;

    public static function labels()
    {
        return [
            self::IMAGE => Yii::t('banner', "Изображение"),
            self::HTML => Yii::t('banner', "HTML"),
        ];
    }
}
