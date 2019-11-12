<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->url;
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Баннеры и страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('banner', Yii::t('banner', 'Редактировать')), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('banner', Yii::t('banner', 'Удалить')), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('banner', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'updated_at',
        ],
    ]) ?>

</div>
