<?php

use yii\helpers\Html;

$this->title = Yii::t('backend', 'Добавить');
$this->params['breadcrumbs'][] = ['label' => Yii::t('static', 'Баннеры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
