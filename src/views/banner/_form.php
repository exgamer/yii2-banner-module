<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\widgets\Pjax;
?>

<div class="post-category-form">
    <?php Pjax::begin(); ?>
    <div class="form-group">
        <?= Html::label(Yii::t('banner', 'Версии'))?>
        <?php foreach (Yii::$app->localeService->catalog() as $key => $locale):?>
            <?= Html::a(
                $locale,
                \yii\helpers\Url::current(['locale' => $key]),
                ['class' => 'btn btn-lg btn-primary ' . ($key == $model->locale ? "active" : "")]
            ) ?>
        <?php endforeach;?>
    </div>



    <?php $form = ActiveForm::begin() ?>
    <?= $form->errorSummary($model) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
            'allowedContent' => true,
        ],
    ]); ?>
    <?= $form->field($model, 'seo_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'domain_id')->dropDownList(
        Yii::$app->domainService->catalog(),
        [
            'prompt' => Yii::t('banner', 'Выберите домен')
        ]
    );?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'from_at')->widget(\yii\jui\DatePicker::className(),
                [
                    'dateFormat' => 'php:Y-m-d',
                    'clientOptions' =>[
                        'changeMonth'=> true,
                        'changeYear'=> true,
                    ]
                ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'to_at')->widget(\yii\jui\DatePicker::className(),
                [
                    'dateFormat' => 'php:Y-m-d',
                    'clientOptions' =>[
                        'changeMonth'=> true,
                        'changeYear'=> true,
                    ]
                ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('banner', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
