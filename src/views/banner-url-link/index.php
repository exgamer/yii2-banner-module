<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kamaelkz\yii2admin\v1\widgets\formelements\Pjax;
use concepture\yii2handbook\converters\LocaleConverter;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\enum\IsDeletedEnum;
use yii\helpers\Url;

$this->setTitle($searchModel::label());
$this->pushBreadcrumbs($this->title);
$this->viewHelper()->pushPageHeader();
?>
<?php Pjax::begin(); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'searchVisible' => true,
    'searchParams' => [
        'model' => $searchModel
    ],
    'columns' => [
        'id',
        'url',
        [
            'attribute'=>'banner_id',
            'value'=>function($data) {
                return $data->getBannerTitle();
            }
        ],
        'sort',
        'created_at',

        [
            'class'=>'yii\grid\ActionColumn',
            'template'=>'{view} {update} {delete}',
        ],
    ],
]); ?>

<?php Pjax::end(); ?>
