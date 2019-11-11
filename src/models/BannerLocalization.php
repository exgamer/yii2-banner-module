<?php
namespace concepture\yii2banner\models;

use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;

/**
 * BannerLocalization model
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sort
 * @property integer $locale
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $seo_name
 * @property integer $status
 * @property datetime $from_at
 * @property datetime $to_at
 * @property datetime $created_at
 * @property datetime $updated_at
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'entity_id',
                    'sort',
                ],
                'integer'
            ],
            [
                [
                    'locale'
                ],
                'integer'
            ],
            [
                [
                    'content'
                ],
                'string'
            ],
            [
                [
                    'title',
                    'seo_name',
                    'image',
                ],
                'string',
                'max'=>1024
            ],
            [
                [
                    'from_at',
                    'to_at'
                ],
                'datetime',
                'format' => 'php:Y-m-d H:i:s'
            ],
            [
                [
                    'from_at',
                    'to_at'
                ],
                'default',
                'value' => null
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('banner','#'),
            'locale' => Yii::t('banner','Язык'),
            'title' => Yii::t('banner','Название'),
            'content' => Yii::t('banner','Контент'),
            'seo_name' => Yii::t('banner','SEO название'),
            'sort' => Yii::t('banner','Сортировка'),
            'image' => Yii::t('banner','Изображение'),
            'from_at' => Yii::t('banner','Дата с'),
            'to_at' => Yii::t('banner','Дата по'),
            'created_at' => Yii::t('banner','Дата создания'),
            'updated_at' => Yii::t('banner','Дата обновления'),
        ];
    }
}
