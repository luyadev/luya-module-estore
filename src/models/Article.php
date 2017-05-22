<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Article.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 *
 * @property integer $id
 * @property integer $product_id
 * @property text $name
 * @property string $sku
 * @property integer $qty_available
 */
class Article extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['name', 'sku'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_article';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-article';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'qty_available' => Yii::t('app', 'Qty Available'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'qty_available'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string'],
            [['sku'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['name', 'sku'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'product_id' => ['selectModel', 'modelClass' => Product::class],
            'name' => 'text',
            'sku' => 'text',
            'qty_available' => 'number',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['product_id', 'name', 'sku', 'qty_available']],
            [['create', 'update'], ['product_id', 'name', 'sku', 'qty_available']],
            ['delete', false],
        ];
    }
}