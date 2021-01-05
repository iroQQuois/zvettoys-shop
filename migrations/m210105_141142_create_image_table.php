<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m210105_141142_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(255)->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-product_id',
            'image',
            'product_id'
        );

        $this->addForeignKey(
            'fk_product_id',
            'image',
            'product_id',
            'product',
            'id',
            'CASCADE',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
