<?php

use yii\helpers\Html;

$this->title = Yii::t('banner', 'Редактировать баннер: {name}', [
    'name' => $model->seo_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Баннеры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $originModel->id]];
$this->params['breadcrumbs'][] = Yii::t('banner', 'Редактировать');
?>
<div class="post-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
