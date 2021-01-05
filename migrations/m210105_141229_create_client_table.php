<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m210105_141229_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'surname' => $this->string(45)->notNull(),
            'email' => $this->string(45)->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}
