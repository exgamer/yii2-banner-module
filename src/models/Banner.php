<?php
namespace concepture\yii2banner\models;

use concepture\yii2user\models\User;
use concepture\yii2logic\validators\UniquePropertyValidator;
use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\TranslitValidator;
use concepture\yii2logic\models\traits\HasLocalizationTrait;
use concepture\yii2logic\models\traits\StatusTrait;
use concepture\yii2handbook\converters\LocaleConverter;
use concepture\yii2handbook\models\traits\DomainTrait;
use concepture\yii2user\models\traits\UserTrait;

/**
 * Banner model
 *
 * @property integer $id
 * @property integer $domain_id
 * @property integer $user_id
 * @property integer $locale
 * @property string $title
 * @property string $content
 * @property string $seo_name
 * @property string $image
 * @property integer $status
 * @property datetime $from_at
 * @property datetime $to_at
 * @property datetime $created_at
 * @property datetime $updated_at
 *
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class Banner extends ActiveRecord
{
    use HasLocalizationTrait;
    use StatusTrait;
    use DomainTrait;
    use UserTrait;

    public $locale;
    public $title;
    public $content;
    public $image;
    public $from_at;
    public $to_at;



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{banner}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'status',
                    'user_id',
                    'domain_id',
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
                    'seo_name',
                ],
                TranslitValidator::className(),
                'source' => 'title'
            ],
            [
                [
                    'seo_name',
                ],
                'unique'
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
            'user_id' => Yii::t('banner','Пользователь'),
            'domain_id' => Yii::t('banner','Домен'),
            'status' => Yii::t('banner','Статус'),
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

    public function afterSave($insert, $changedAttributes)
    {
        $this->saveLocalizations();

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->deleteLocalizations();

        return parent::afterDelete();
    }

    public function afterFind()
    {
        $this->setLocalizations();

        return parent::afterFind();
    }

    public static function getLocaleConverterClass()
    {
        return LocaleConverter::class;
    }
}
