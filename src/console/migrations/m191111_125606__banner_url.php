<?php

use concepture\yii2logic\console\migrations\Migration;

/**
 * Class m191111_125606__banner_url
 */
class m191111_125606__banner_url extends Migration
{
    function getTableName()
    {
        return 'banner_url_link';
    }

    public function up()
    {
        $this->addTable([
            'id' => $this->bigPrimaryKey(),
            'banner_id' => $this->bigInteger()->notNull(),
            'type' => $this->integer()->notNull(),
            'url' => $this->string(255),
            'url_md5_hash' => $this->string(32),
            'group' => $this->string(50),
            'sort' => $this->integer()->defaultValue(0),
            'created_at' => $this->dateTime()->defaultValue(new \yii\db\Expression("NOW()")),
            'updated_at' => $this->dateTime()
        ]);
        $this->addIndex(['type']);
        $this->addIndex(['banner_id']);
        $this->addIndex(['group']);
        $this->addIndex(['url']);
        $this->addUniqueIndex(['banner_id', 'url_md5_hash']);
        if ($this->isMysql()) {
            $this->execute("ALTER TABLE banner_url_link
            ADD INDEX bu_url_md5_hash_index
            USING HASH (url_md5_hash);");
        }
        if ($this->isPostgres()) {
            $this->execute("CREATE INDEX bu_url_md5_hash_index 
            ON banner_url_link USING HASH (url_md5_hash);;");
        }
        $this->addForeign('banner_id', 'banner','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191111_125606__banner_url cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191111_125606__banner_url cannot be reverted.\n";

        return false;
    }
    */
}
