<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191002_151217_static_table_localization
 */
class m191002_151217_banner_localization extends Migration
{
    function getTableName()
    {
        return 'banner_localization';
    }

    public function up()
    {
        $this->addTable([
//            'id' => $this->bigPrimaryKey(),
            'entity_id' => $this->bigInteger()->notNull(),
            'locale' => $this->bigInteger()->notNull(),
            'image' => $this->string(1024),
            'title' => $this->string(1024),
            'url' => $this->string(1024),
            'target' => $this->string(20),
            'content' => $this->text(),
            'from_at' => $this->date(),
            'to_at' => $this->date(),
        ]);
        $this->addPK(['entity_id', 'locale'], true);
        $this->addIndex(['entity_id']);
//        $this->addIndex(['entity_id', 'locale'], true);
        $this->addIndex(['locale']);
        $this->addForeign('entity_id', 'banner','id');
        $this->addForeign('locale', 'locale','id');
    }
}
