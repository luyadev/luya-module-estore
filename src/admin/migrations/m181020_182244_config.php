<?php

use yii\db\Migration;

/**
 * Class m181020_182244_config
 */
class m181020_182244_config extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%estore_config}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(80)->unique(),
            'type' => $this->string(30)->defaultValue('text')->notNull(),
            'value' => $this->string(255)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%estore_config}}');
    }
}
