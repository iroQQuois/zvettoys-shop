<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $image
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
            'image' => 'Image',
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
     * @param $filename
     * @return bool
     */
    public function saveImage(string $filename): bool
    {
        $this->image = $filename;

        return $this->save(false);
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if ($this->image)
        {
            return '/zvettoys.loc/web/uploads/' . $this->image;
        }

        return '/zvettoys.loc/web/no-image.png';
    }

    public function deleteImage(): void
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }
}
