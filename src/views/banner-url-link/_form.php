<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="post-category-form">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->errorSummary($model) ?>
    <? echo $form->field($model, 'banner_id')->hiddenInput()->label(false); ?>
    <div class="form-group">
    <?= Html::activeLabel($model, 'banner_id')?>
    <?= \yii\jui\AutoComplete::widget([
        'name' => 'name',
        'options' => ['class' => 'form-control'],
        'clientOptions' => [
            'source' => \yii\helpers\Url::to(['/banner/banner/list']),
            'minLength'=>'2',
            'autoFill'=>true,
            'select' => new \yii\web\JsExpression("function( event, ui ) {
			        $('#bannerurllinkform-banner_id').val(ui.item.id);
             }")]
    ]); ?>
    <?= Html::error($model, 'user_id')?>
    </div>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('banner', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
