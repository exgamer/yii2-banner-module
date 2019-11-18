<?php
namespace concepture\yii2banner\models;

use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;

/**
 * BannerLocalization model
 *
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerLocalization extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{banner_localization}}';
    }
}
