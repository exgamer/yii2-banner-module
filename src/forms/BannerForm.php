<?php
namespace concepture\yii2banner\forms;


use concepture\yii2banner\enum\BannerTypesEnum;
use kamaelkz\yii2admin\v1\forms\BaseForm;
use concepture\yii2logic\enum\StatusEnum;
use Yii;

/**
 * Class BannerForm
 * @package concepture\yii2banner\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerForm extends BaseForm
{
    public $type = BannerTypesEnum::IMAGE;
    public $user_id;
    public $domain_id;
    public $locale = "ru";
    public $title;
    public $content;
    public $alias;
    public $image;
    public $from_at;
    public $to_at;
    public $url;
    public $target;
    public $status = StatusEnum::INACTIVE;

    protected function extendedScenarios()
    {
        return [
            BannerTypesEnum::IMAGE => [
                'content'
            ],
            BannerTypesEnum::HTML => [
                'image'
            ]
        ];
    }

    /**
     * @see Form::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'alias',
                    'locale',
                    'image',
                    'type',
                    'content'
                ],
                'required'
            ],
        ];
    }

    public function beforeValidate()
    {
        /**
         * Если выставлен тип баннера
         * устанавливаем сценарий валидации
         */
        if ($this->type) {
            $this->setScenario($this->type);
        }

        return true;
    }
}