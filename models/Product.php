<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $structure
 * @property string|null $extra
 * @property string|null $collection
 * @property int $enabled
 * @property string|null $sale
 * @property int $category_id
 * @property int|null $manufacturer_id
 *
 * @property Image[] $images
 * @property Category $category
 * @property Manufacturer $manufacturer
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'structure', 'enabled', 'category_id'], 'required'],
            [['enabled', 'category_id', 'manufacturer_id'], 'integer'],
            [['name', 'collection', 'sale'], 'string', 'max' => 45],
            [['description', 'structure', 'extra'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
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
            'description' => 'Description',
            'structure' => 'Structure',
            'extra' => 'Extra',
            'collection' => 'Collection',
            'enabled' => 'Enabled',
            'sale' => 'Sale',
            'category_id' => 'Category ID',
            'manufacturer_id' => 'Manufacturer ID',
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Manufacturer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }
}
