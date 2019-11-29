<?php

namespace concepture\yii2banner\search;

use concepture\yii2banner\models\BannerUrlLink;
use yii\db\ActiveQuery;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Class BannerUrlLinkSearch
 * @package concepture\yii2banner\search
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerUrlLinkSearch extends BannerUrlLink
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
                    'banner_id'
                ],
                'integer'
            ],
            [
                [
                    'url'
                ],
                'safe'
            ],
        ];
    }

    public function extendQuery(ActiveQuery $query)
    {
        $query->andFilterWhere([
            'id' => $this->id
        ]);
        $query->andFilterWhere([
            'banner_id' => $this->banner_id
        ]);
        $query->andFilterWhere(['like', "url", $this->url]);
    }
}
