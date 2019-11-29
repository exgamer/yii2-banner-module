<?php

use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\enum\IsDeletedEnum;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


$this->title = Yii::t('banner', 'Баннеры');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('banner', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <div class="form-group">
        <?= Html::label(Yii::t('banner', 'Версии'))?>
        <?php foreach (Yii::$app->localeService->catalog() as $key => $locale):?>
            <?= Html::a(
                $locale,
                \yii\helpers\Url::current(['locale' => $key]),
                ['class' => 'btn btn-lg btn-primary ' . ($key ==  $searchModel::currentLocale()  ? "active" : "")]
            ) ?>
        <?php endforeach;?>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
//            [
//                'attribute'=>'locale',
//                'filter'=>Yii::$app->localeService->getAllList('locale', 'locale')
//            ],
//            'seo_name',
//            'image',
            'from_at',
            'to_at',
//            [
//                'format' => ['image',['width'=>'100']],
//                'value'=>function($data) {
//                    return $data->image;
//                },
//            ],
            [
                'attribute'=>'type',
                'filter'=> \concepture\yii2banner\enum\BannerTypesEnum::arrayList(),
                'value'=>function($data) {
                    return $data->getBannerTypeLabel();
                }
            ],
            [
                'attribute'=>'status',
                'filter'=> StatusEnum::arrayList(),
                'value'=>function($data) {
                    return $data->statusLabel();
                }
            ],
            [
                'attribute'=>'Версии',
                'value'=>function($data) {

                    return implode(",", $data->locales());
                }
            ],
            'created_at',
            [
                'attribute'=>'is_deleted',
                'filter'=> IsDeletedEnum::arrayList(),
                'value'=>function($data) {
                    return $data->isDeletedLabel();
                }
            ],

            [
                'class'=>'yii\grid\ActionColumn',
                'template'=>'{view} {update} {activate} {deactivate} {delete}',
                'buttons'=>[
                    'view'=> function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            ['view', 'id' => $model['id'], 'locale' => $model['locale']],
                            ['data-pjax' => '0']
                        );
                    },
                    'update'=> function ($url, $model) {
                        if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                            return '';
                        }

                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            ['update', 'id' => $model['id'], 'locale' => $model['locale']],
                            ['data-pjax' => '0']
                        );
                    },
                    'activate'=> function ($url, $model) {
                        if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                            return '';
                        }
                        if ($model['status'] == StatusEnum::ACTIVE){
                            return '';
                        }
                        return Html::a(
                            '<span class="glyphicon glyphicon-ok"></span>',
                            ['status-change', 'id' => $model['id'], 'status' => StatusEnum::ACTIVE],
                            [
                                'title' => Yii::t('banner', 'Активировать'),
                                'data-confirm' => Yii::t('banner', 'Активировать ?'),
                                'data-method' => 'post',
                            ]
                        );
                    },
                    'deactivate'=> function ($url, $model) {
                        if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                            return '';
                        }
                        if ($model['status'] == StatusEnum::INACTIVE){
                            return '';
                        }
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            ['status-change', 'id' => $model['id'], 'status' => StatusEnum::INACTIVE],
                            [
                                'title' => Yii::t('banner', 'Деактивировать'),
                                'data-confirm' => Yii::t('banner', 'Деактивировать ?'),
                                'data-method' => 'post',
                            ]
                        );
                    },
                    'delete'=> function ($url, $model) {
                        if ($model['is_deleted'] == IsDeletedEnum::DELETED){
                            return '';
                        }

                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            ['delete', 'id' => $model['id']],
                            [
                                'title' => Yii::t('banner', 'Удалить'),
                                'data-confirm' => Yii::t('banner', 'Удалить ?'),
                                'data-method' => 'post',
                            ]
                        );
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
