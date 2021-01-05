<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%productandorder}}`.
 */
class m210105_141209_create_product_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_order}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull()
        ]);

        $this->createIndex(
            'idx-order_id',
            'product_order',
            'order_id'
        );

        $this->addForeignKey(
            'fk_order_id',
            'product_order',
            'order_id',
            'order',
            'id',
        'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_order_id',
            'product_order'
        );

        $this->dropIndex(
            'idx-order_id',
            'product_order'
        );

        $this->dropTable('{{%product_order}}');
    }
}
