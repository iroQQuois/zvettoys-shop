<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%collection}}`.
 */
class m210105_141127_create_collection_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%collection}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%collection}}');
    }
}
