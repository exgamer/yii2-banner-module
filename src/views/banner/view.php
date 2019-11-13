<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Баннеры'), 'url' => ['index']];
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

    <div class="form-group">
        <?= Html::label(Yii::t('banner', 'Версии'))?>
        <?php foreach ($model->locales() as $key => $locale):?>
            <?= Html::a(
                $locale,
                \yii\helpers\Url::current(['locale' => $key]),
                ['class' => 'btn btn-lg btn-primary ' . ($key == $model->locale ? "active" : "")]
            ) ?>
        <?php endforeach;?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'url',
            'target',
            [
                'attribute'=>'Версии',
                'value'=>function($model) {

                    return implode(",", $model->locales());
                }
            ],
            'seo_name',
            [
                'attribute'=>'status',
                'value'=>$model->statusLabel(),
            ],
            [
                'attribute'=>'domain_id',
                'value'=>$model->getDomainName(),
            ],
            'image',
            'from_at',
            'to_at',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
