<?php

namespace concepture\yii2banner\search;

use concepture\yii2banner\models\Banner;
use yii\db\ActiveQuery;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class BannerSearch
 * @package concepture\yii2static\search
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerSearch extends Banner
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'status',
                    'domain_id',
                    'type',
                    'is_deleted',
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'alias'
                ],
                'safe'
            ],
        ];
    }

    public function extendQuery(ActiveQuery $query)
    {
        $query->andFilterWhere([
            static::tableName().'.id' => $this->id
        ]);
        $query->andFilterWhere([
            'status' => $this->status
        ]);
        $query->andFilterWhere([
            'type' => $this->type
        ]);
        $query->andFilterWhere([
            'domain_id' => $this->domain_id
        ]);
        $query->andFilterWhere([
            'is_deleted' => $this->is_deleted
        ]);
        $query->andFilterWhere(['like', "alias", $this->alias]);
        static::$search_by_locale_callable = function($q, $localizedAlias){
            $q->andFilterWhere(['like', "{$localizedAlias}.title", $this->title]);
        };
    }

    public function extendDataProvider(ActiveDataProvider $dataProvider)
    {
        $this->addSortByLocalizationAttribute($dataProvider, 'title');
    }

    public static function getListSearchKeyAttribute()
    {
        return 'id';
    }

    public static function getListSearchAttribute()
    {
        return 'title';
    }
}
