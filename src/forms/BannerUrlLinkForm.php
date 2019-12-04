<?php
namespace concepture\yii2banner\forms;


use kamaelkz\yii2admin\v1\forms\BaseForm;
use Yii;

/**
 * Class BannerUrlLinkForm
 * @package concepture\yii2banner\forms
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerUrlLinkForm extends BaseForm
{
    public $banner_id;
    public $url;
    public $type;
    public $group;
    public $url_md5_hash;
    public $sort;

    /**
     * @see Form::formRules()
     */
    public function formRules()
    {
        return [
            [
                [
                    'banner_id',
                    'type',
                ],
                'required'
            ],
        ];
    }
}
