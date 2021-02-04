<?php

use yii\db\Migration;

/**
 * Table for save information about apples `{{%apple_storage}}`.
 */
class m210204_113135_create_apple_storage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple_storage}}', [
            'id' => $this->primaryKey(),
            'state' => $this->smallInteger(),
            'color' => $this->string(50),
            'capacity' => $this->float()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultValue(null),
            'fell_at' => $this->timestamp()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple_storage}}');
    }
}
