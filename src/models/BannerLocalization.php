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
 * @property integer $status
 * @property datetime $from_at
 * @property datetime $to_at
 * @property string $url
 * @property string $target
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
                    'entity_id'
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
                    'image',
                    'url',
                ],
                'string',
                'max'=>1024
            ],
            [
                [
                    'target'
                ],
                'string',
                'max'=>20
            ],
            [
                [
                    'from_at',
                    'to_at'
                ],
                'date',
                'format' => 'php:Y-m-d'
            ],
            [
                [
                    'from_at',
                    'to_at'
                ],
                'default',
                'value' => null
            ],
            ['from_at', 'compare', 'compareAttribute' => 'to_at', 'operator' => '<=', 'enableClientValidation' => false]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('banner','#'),
            'locale' => Yii::t('banner','Язык'),
            'title' => Yii::t('banner','Название'),
            'content' => Yii::t('banner','Контент'),
            'sort' => Yii::t('banner','Сортировка'),
            'image' => Yii::t('banner','Изображение'),
            'from_at' => Yii::t('banner','Дата с'),
            'to_at' => Yii::t('banner','Дата по'),
            'url' => Yii::t('banner','Ссылка'),
            'target' => Yii::t('banner','Атрибут target ссылки'),
            'created_at' => Yii::t('banner','Дата создания'),
            'updated_at' => Yii::t('banner','Дата обновления'),
        ];
    }
}
