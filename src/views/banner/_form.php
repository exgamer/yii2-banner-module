<?php

use yii\helpers\Html;
use kamaelkz\yii2admin\v1\widgets\ {
    formelements\multiinput\MultiInput,
    formelements\editors\froala\FroalaEditor,
    formelements\activeform\ActiveForm,
    formelements\Pjax,
    formelements\pickers\DatePicker,
    formelements\pickers\TimePicker
};
use concepture\yii2banner\enum\BannerTypesEnum;
use concepture\yii2handbook\enum\TargetAttributeEnum;
use kamaelkz\yii2admin\v1\modules\uikit\enum\UiikitEnum;
use kamaelkz\yii2cdnuploader\enum\StrategiesEnum;
use kamaelkz\yii2cdnuploader\widgets\CdnUploader;
?>

<?php Pjax::begin(['formSelector' => '#banner-form']); ?>
<?php if (Yii::$app->localeService->catalogCount() > 1): ?>
    <ul class="nav nav-tabs nav-tabs-solid nav-justified bg-light">
        <?php foreach (Yii::$app->localeService->catalog() as $key => $locale):?>
            <li class="nav-item">
                <?= Html::a(
                    $locale,
                    \yii\helpers\Url::current(['locale' => $key]),
                    ['class' => 'nav-link ' . ($key ==  $model->locale   ? "active" : "")]
                ) ?>
            </li>
        <?php endforeach;?>
    </ul>
<?php endif; ?>
<?php $form = ActiveForm::begin(['id' => 'banner-form']); ?>
    <div class="card">
        <div class="card-body text-right">
            <?=  Html::submitButton(
                '<b><i class="icon-checkmark3"></i></b>' . Yii::t('yii2admin', 'Сохранить'),
                [
                    'class' => 'btn bg-success btn-labeled btn-labeled-left ml-1'
                ]
            ); ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form
                        ->field($model, 'type')
                        ->dropDownList(BannerTypesEnum::arrayList(), [
                            'class' => 'form-control form-control-uniform active-form-refresh-control',
                            'prompt' => ''
                        ]);
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <?php if ($model->type == BannerTypesEnum::IMAGE) :?>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <?= $form
                            ->field($model, 'image')
                            ->widget(CdnUploader::class, [
                                'model' => $model,
                                'attribute' => 'image',
                                'strategy' => StrategiesEnum::BY_REQUEST,
                                'resizeBigger' => false,
//                                    'width' => 313,
//                                    'height' => 235,
                                'options' => [
                                    'plugin-options' => [
                                        # todo: похоже не пашет
                                        'maxFileSize' => 2000000,
                                    ]
                                ],
                                'clientEvents' => [
                                    'fileuploaddone' => new \yii\web\JsExpression('function(e, data) {
                                                    console.log(e);
                                                }'),
                                    'fileuploadfail' => new \yii\web\JsExpression('function(e, data) {
                                                    console.log(e);
                                                }'),
                                ],
                            ])
                            ->error(false)
                            ->hint(false);
                        ?>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($model->type == BannerTypesEnum::HTML) :?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?= $form
                            ->field($model, 'content')
                            ->widget(FroalaEditor::class, [
                                'model' => $model,
                                'attribute' => 'content',
                                'clientOptions' => [
                                    'attribution' => false,
                                    'heightMin' => 200,
                                    'toolbarSticky' => true,
                                    'toolbarInline'=> false,
                                    'theme' =>'royal', //optional: dark, red, gray, royal
                                    'language' => Yii::$app->language,
                                    'quickInsertTags' => [],
                                ]
                            ]);
                        ?>
                    </div>
                </div>
            <?php endif;?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form
                        ->field($model, 'target')
                        ->dropDownList(TargetAttributeEnum::arrayList(), [
                            'class' => 'form-control custom-select',
                            'prompt' => Yii::t('banner', 'Выберите значение target')
                        ]);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form
                        ->field($model,'from_at', [
                            'template' => '
                                                {label}
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="btn bg-primary">
                                                            <i class="icon-calendar2"></i>
                                                        </span>
                                                    </span>
                                                    {input}
                                                </div>
                                                {error}'
                        ])
                        ->widget(DatePicker::class)
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form
                        ->field($model,'to_at', [
                            'template' => '
                                                {label}
                                                <div class="input-group">
                                                    <span class="input-group-prepend">
                                                        <span class="btn bg-primary">
                                                            <i class="icon-calendar2"></i>
                                                        </span>
                                                    </span>
                                                    {input}
                                                </div>
                                                {error}',
                        ])
                        ->widget(DatePicker::class,[
                            'clientOptions' => [
                                'max' => false
                            ]
                        ])
                    ?>
                </div>
            </div>
        </div>
        <div class="card-body text-right">
            <?=  Html::submitButton(
                '<b><i class="icon-checkmark3"></i></b>' . Yii::t('yii2admin', 'Сохранить'),
                [
                    'class' => 'btn bg-success btn-labeled btn-labeled-left ml-1'
                ]
            ); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>