<?php

namespace luya\estore\models;

use Yii;

/**
 * This is the model class for table "estore_product_attribute_value".
 *
 * @property integer $product_id
 * @property integer $set_id
 * @property integer $attribute_id
 * @property string $value
 *
 * @property SetAttribute $setAttribute
 */
class ProductAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_product_attribute_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'set_id', 'attribute_id'], 'required'],
            [['product_id', 'set_id', 'attribute_id'], 'integer'],
            [['value'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'attribute_id' => 'Attribute ID',
            'set_id' => 'Set ID',
            'value' => 'Value',
        ];
    }

    public function getSetAttribute()
    {
        return $this->hasOne(SetAttribute::class, ['id' => 'attribute_id']);
    }
}
