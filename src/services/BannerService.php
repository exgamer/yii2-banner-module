<?php
namespace concepture\yii2banner\services;

use concepture\yii2logic\forms\Model;
use concepture\yii2logic\services\Service;
use Yii;
use concepture\yii2logic\services\traits\StatusTrait;
use concepture\yii2logic\services\traits\LocalizedReadTrait;
use yii\db\ActiveQuery;
use concepture\yii2logic\enum\StatusEnum;
use concepture\yii2logic\enum\IsDeletedEnum;

/**
 * Class BannerService
 * @package concepture\yii2banner\service
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class BannerService extends Service
{
    use StatusTrait;
    use LocalizedReadTrait;

    protected function beforeCreate(Model $form)
    {
        $form->user_id = Yii::$app->user->identity->id;
    }

    /**
     * Возвращает активные баннеры для текущего url по хешу md5 url
     * с учетом from_at и to_at
     *
     * @return array
     */
    public function getBannersForCurrentUrl()
    {
        $current = Yii::$app->getRequest()->getPathInfo();
        $md5 = md5($current);
        $modelClass = $this->getRelatedModelClass();
        $modelClass::$search_by_locale_callable = function($q, $localizedAlias) {
            $q->andWhere(
                "({$localizedAlias}.from_at is null and {$localizedAlias}.to_at is null) OR".
                "(now() between {$localizedAlias}.from_at and {$localizedAlias}.to_at and {$localizedAlias}.from_at is not null and {$localizedAlias}.to_at is not null) OR".
                "({$localizedAlias}.from_at < now() and {$localizedAlias}.from_at is not null and {$localizedAlias}.to_at is  null) OR".
                "({$localizedAlias}.to_at > now() and {$localizedAlias}.from_at is  null and {$localizedAlias}.to_at is not null)"
            );
        };

        return $this->getAllByCondition(function(ActiveQuery $query) use($md5) {
            $domainId = Yii::$app->domainService->getCurrentDomainId();
            $sql = "domain_id = :domain_id OR domain_id IS NULL";
            $query->andWhere($sql, [':domain_id' => $domainId]);
            $query->innerJoinWith('urlLinks');
            $query->andWhere("u.url_md5_hash = :url_md5_hash", [':url_md5_hash' => $md5]);
            $query->andWhere("status = :status", [':status' => StatusEnum::ACTIVE]);
            $query->andWhere("is_deleted = :is_deleted", [':is_deleted' => IsDeletedEnum::NOT_DELETED]);
            $query->orderBy("u.sort ASC");
        });
    }
}
