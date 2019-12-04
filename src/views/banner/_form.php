<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\widgets\Pjax;
use concepture\yii2handbook\enum\TargetAttributeEnum;
use concepture\yii2banner\enum\BannerTypesEnum;
?>

<div class="post-category-form">
    <?php Pjax::begin(['id' => 'form']); ?>
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



    <?php $form = ActiveForm::begin(['enableClientValidation'=>false]) ?>
    <?= $form->errorSummary($model) ?>
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList(
        BannerTypesEnum::arrayList(),
        [
            'onchange'=> "$.pjax.reload({container: '#form', 'type': 'POST', 'data': {'BannerForm[type]': this.value, 'reload': true}});"
            //'prompt' => Yii::t('banner', 'Выберите тип баннера')
        ]
    );?>
    <?php if ($model->type == BannerTypesEnum::IMAGE) :?>
        <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    <?php endif;?>

    <?php if ($model->type == BannerTypesEnum::HTML) :?>
        <?= $form->field($model, 'content')->widget(CKEditor::className(),[
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
                'allowedContent' => true,
            ],
        ]); ?>
    <?php endif;?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'target')->dropDownList(
        TargetAttributeEnum::arrayList(),
        [
            'prompt' => Yii::t('banner', 'Выберите значение target')
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
