<?php
namespace concepture\yii2banner\models;

use concepture\yii2handbook\converters\LocaleConverter;
use concepture\yii2user\models\User;
use Yii;
use concepture\yii2logic\models\ActiveRecord;
use concepture\yii2logic\validators\MD5Validator;
use concepture\yii2banner\models\traits\BannerTrait;

/**
 * BannerUrlLink model
 *
 * @property integer $id
 * @property integer $banner_id
 * @property integer $sort
 * @property string $url
 * @property string $url_md5_hash
 * @property datetime $created_at
 * @property datetime $updated_at
 *
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerUrlLink extends ActiveRecord
{
    use BannerTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{banner_url_link}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'banner_id',
                    'sort'
                ],
                'integer'
            ],
            [
                [
                    'url',
                    'url_md5_hash',
                ],
                'string',
                'max'=>1024
            ],
            [
                [
                    'url_md5_hash',
                ],
                MD5Validator::className(),
                'source' => 'url'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('static','#'),
            'banner_id' => Yii::t('static','Баннер'),
            'sort' => Yii::t('static','Сортировка'),
            'url' => Yii::t('static','url страницы'),
            'url_md5_hash' => Yii::t('static','md5 url страницы'),
            'created_at' => Yii::t('static','Дата создания'),
            'updated_at' => Yii::t('static','Дата обновления'),
        ];
    }
}
