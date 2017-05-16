<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Article Price.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 *
 * @property integer $article_id
 * @property integer $currency_id
 * @property integer $qty
 * @property float $price
 */
class ArticlePrice extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = [''];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_article_price';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-articleprice';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => Yii::t('app', 'Article ID'),
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
            [['article_id', 'currency_id', 'qty', 'price'], 'required'],
            [['article_id', 'currency_id', 'qty'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return [''];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'article_id' => 'number',
            'currency_id' => 'number',
            'qty' => 'number',
            'price' => 'decimal',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['price']],
            [['create', 'update'], ['article_id', 'currency_id', 'qty', 'price']],
            ['delete', false],
        ];
    }
}