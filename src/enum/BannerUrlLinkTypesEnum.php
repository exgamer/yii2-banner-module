<?php

namespace concepture\yii2banner\enum;

use Yii;
use concepture\yii2logic\enum\Enum;

/**
 * Класс констант для типов  banner_url_link
 *
 * Class BannerUrlLinkTypesEnum
 * @package concepture\yii2banner\enum
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerUrlLinkTypesEnum extends Enum
{
    const TEXT = 0;
    const REGEX = 1;

    public static function labels()
    {
        return [
            self::TEXT => Yii::t('banner', "Текст"),
            self::REGEX => Yii::t('banner', "Регулярка"),
        ];
    }
}
