<?php
namespace concepture\yii2banner\forms;


use concepture\yii2banner\enum\BannerTypesEnum;
use concepture\yii2logic\forms\Form;
use concepture\yii2logic\enum\StatusEnum;
use Yii;

/**
 * Class BannerForm
 * @package concepture\yii2banner\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerForm extends Form
{
    public $type;
    public $user_id;
    public $domain_id;
    public $locale = "ru";
    public $title;
    public $content;
    public $seo_name;
    public $image;
    public $from_at;
    public $to_at;
    public $url;
    public $target;
    public $status = StatusEnum::INACTIVE;

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        /**
         * Сценарий для баннера с изображением
         */
        $scenarios[BannerTypesEnum::IMAGE] = ['title', 'locale', 'image', 'type'];
        /**
         * Сценарий для баннера с HTML контентом
         */
        $scenarios[BannerTypesEnum::HTML] = ['title', 'locale', 'content', 'type'];

        return $scenarios;
    }

    /**
     * @see Form::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'title',
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
        if ($this->type) {
            $this->setScenario($this->type);
        }

        return true;
    }
}