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

$bannerName = "";
if (isset($originModel))
{
    $bannerName = $originModel->getBannerTitle();
}
?>

<?php Pjax::begin(['formSelector' => '#bannerurllinkform-form']); ?>
<?php $form = ActiveForm::begin(['id' => 'bannerurllinkform-form']); ?>
<?= $form->errorSummary($model);?>
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
                        ->dropDownList(\concepture\yii2banner\enum\BannerUrlLinkTypesEnum::arrayList(), [
                            'class' => 'form-control form-control-uniform active-form-refresh-control',
                            'prompt' => ''
                        ]);
                    ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= Html::activeHiddenInput($model, 'banner_id') ?>
                    <?= Html::activeLabel($model, 'banner_id')?>
                    <?= \yii\jui\AutoComplete::widget([
                        'name' => 'name',
                        'value' => $bannerName,
                        'options' => ['class' => 'form-control'],
                        'clientOptions' => [
                            'source' => \yii\helpers\Url::to(['/banner/banner/list']),
                            'minLength'=>'2',
                            'autoFill'=>true,
                            'select' => new \yii\web\JsExpression("function( event, ui ) {
                                    $('#bannerurllinkform-banner_id').val(ui.item.id);
                             }")]
                    ]); ?>
                    <?= Html::error($model, 'banner_id', ['class' => 'text-danger form-text'])?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
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