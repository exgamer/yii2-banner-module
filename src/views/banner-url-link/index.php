<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


$this->title = Yii::t('banner', 'Баннеры и страницы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('banner', 'Добавить'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'url',
            [
                'attribute'=>'banner_id',
//                'filter'=> Yii::$app->domainService->catalog(),
                'value'=>function($data) {
                    return $data->getBannerTitle();
                }
            ],
            'sort',
            'created_at',
            //'updated_at',

            [
                'class'=>'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
