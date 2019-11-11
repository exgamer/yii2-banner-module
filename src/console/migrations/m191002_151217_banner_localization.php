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
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'locale' => $this->integer()->notNull(),
            'seo_name' => $this->string(1024),
            'image' => $this->string(1024),
            'title' => $this->string(1024),
            'content' => $this->text(),
            'sort' => $this->integer()->defaultValue(0),
            'from_at' => $this->dateTime(),
            'to_at' => $this->dateTime(),
        ]);
        $this->addIndex(['entity_id']);
        $this->addIndex(['entity_id', 'locale'], true);
        $this->addIndex(['locale']);
    }
}
