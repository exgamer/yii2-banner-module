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
                    'domain_id'
                ],
                'integer'
            ],
            [
                [
                    'title',
                    'seo_name'
                ],
                'safe'
            ],
        ];
    }

    protected function extendQuery(ActiveQuery $query)
    {
        $query->andFilterWhere([
            'id' => $this->id
        ]);
        $query->andFilterWhere([
            'status' => $this->status
        ]);
        $query->andFilterWhere([
            'domain_id' => $this->domain_id
        ]);
        static::$search_by_locale_callable = function($q, $localizedAlias){
            $q->andFilterWhere(['like', "{$localizedAlias}.seo_name", $this->seo_name]);
            $q->andFilterWhere(['like', "{$localizedAlias}.title", $this->title]);
        };
    }

    protected function extendDataProvider(ActiveDataProvider $dataProvider)
    {
        $this->addSortByLocalizationAttribute($dataProvider, 'seo_name');
        $this->addSortByLocalizationAttribute($dataProvider, 'title');
    }
}
