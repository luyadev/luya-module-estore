<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estore_set_attribute_ref".
 *
 * @property integer $set_id
 * @property integer $attribute_id
 */
class SetAttributeRef extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_set_attribute_ref';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['set_id', 'attribute_id'], 'required'],
            [['set_id', 'attribute_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'set_id' => 'Set ID',
            'attribute_id' => 'Attribute ID',
        ];
    }
}