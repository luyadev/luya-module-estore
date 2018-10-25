<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\SelectRelationActiveQuery;

/**
 * Product Price.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property integer $product_id
 * @property integer $currency_id
 * @property integer $qty
 * @property float $price
 */
class ProductPrice extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_product_price';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-productprice';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'qty' => Yii::t('app', 'Qty'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'currency_id', 'qty', 'price'], 'required'],
            [['product_id', 'currency_id', 'qty'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'product_id' => ['class' => SelectRelationActiveQuery::class, 'query' => $this->getProduct(), 'labelField' => ['name'], 'asyncList' => true],
            'currency_id' => ['class' => SelectRelationActiveQuery::class, 'query' => $this->getCurrency(), 'labelField' => ['name'], 'asyncList' => true],
            'qty' => 'number',
            'price' => 'decimal',
        ];
    }
    
    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
    
    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::class, ['id' => 'currency_id']);
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['product_id', 'currency_id', 'price']],
            [['create', 'update'], ['product_id', 'currency_id', 'qty', 'price']],
            ['delete', false],
        ];
    }
}
