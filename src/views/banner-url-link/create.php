<?php

use yii\helpers\Html;

$this->title = Yii::t('banner', 'Добавить');
$this->params['breadcrumbs'][] = ['label' => Yii::t('banner', 'Баннеры и страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
