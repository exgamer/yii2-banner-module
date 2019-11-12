<?php

use yii\helpers\Html;

$this->title = Yii::t('banner', 'Редактировать баннер на странице: {name}', [
    'name' => $model->url,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Баннеры и страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->url, 'url' => ['view', 'id' => $originModel->id]];
$this->params['breadcrumbs'][] = Yii::t('banner', 'Редактировать');
?>
<div class="post-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
