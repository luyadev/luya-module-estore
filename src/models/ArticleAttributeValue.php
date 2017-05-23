<?php

namespace luya\estore\models;

use Yii;

/**
 * This is the model class for table "estore_article_attribute_value".
 *
 * @property integer $article_id
 * @property integer $set_id
 * @property integer $attribute_id
 * @property string $value
 */
class ArticleAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_article_attribute_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'set_id', 'attribute_id'], 'required'],
            [['article_id', 'set_id', 'attribute_id'], 'integer'],
            [['value'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'attribute_id' => 'Attribute ID',
            'set_id' => 'Set ID',
            'value' => 'Value',
        ];
    }
}