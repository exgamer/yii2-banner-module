<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191002_151207_static_table
 */
class m191002_151207_banner extends Migration
{
    function getTableName()
    {
        return 'banner';
    }

    public function up()
    {
        $this->addTable([
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'domain_id' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()")),
            'updated_at' => $this->dateTime()->append('ON UPDATE NOW()')
        ]);
        $this->addIndex(['user_id']);
        $this->addIndex(['domain_id']);
        $this->addIndex(['status']);
    }
}
