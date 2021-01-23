<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210105_141053_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'description' => $this->string(255)->notNull(),
            'structure' => $this->string(255)->notNull(),
            'extra' => $this->string(255)->null(),
            'collection' => $this->string(45)->null(),
            'enabled' => $this->boolean()->notNull(),
            'sale' => $this->string(45)->null(),
            'category_id' => $this->integer()->notNull(),
            'manufacturer_id' => $this->integer()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
