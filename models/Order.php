<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string|null $email
 * @property string $delivery_date
 * @property string|null $delivery_price
 * @property string|null $comment
 * @property string $payment_method
 * @property string $status
 *
 * @property ProductOrder[] $productOrders
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'phone', 'delivery_date', 'payment_method', 'status'], 'required'],
            [['name', 'surname', 'phone', 'email', 'delivery_date', 'delivery_price', 'payment_method', 'status'], 'string', 'max' => 45],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'phone' => 'Phone',
            'email' => 'Email',
            'delivery_date' => 'Delivery Date',
            'delivery_price' => 'Delivery Price',
            'comment' => 'Comment',
            'payment_method' => 'Payment Method',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[ProductOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrders()
    {
        return $this->hasMany(ProductOrder::className(), ['order_id' => 'id']);
    }
}
