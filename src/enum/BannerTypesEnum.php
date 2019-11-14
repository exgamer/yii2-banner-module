<?php

namespace concepture\yii2banner\enum;

use Yii;
use concepture\yii2logic\enum\Enum;

class BannerTypesEnum extends Enum
{
    const IMAGE = 1;
    const HTML = 2;

    public static function labels()
    {
        return [
            self::IMAGE => Yii::t('banner', "Изображение"),
            self::HTML => Yii::t('banner', "HTML"),
        ];
    }
}
