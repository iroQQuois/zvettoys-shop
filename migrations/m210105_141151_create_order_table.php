<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m210105_141151_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'surname' => $this->string(45)->notNull(),
            'phone' => $this->string(45)->notNull(),
            'email' => $this->string(45)->null(),
            'delivery_date' => $this->string(45)->notNull(),
            'delivery_price' => $this->string(45)->null(),
            'comment' => $this->string(255)->null(),
            'payment_method' => $this->string(45)->notNull(),
            'status'=> $this->string(45)->notNull()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
