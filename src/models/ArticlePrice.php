<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\SelectRelationActiveQuery;

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
            'article_id' => Yii::t('estoreadmin', 'Article ID'),
            'currency_id' => Yii::t('estoreadmin', 'Currency ID'),
            'qty' => Yii::t('estoreadmin', 'Qty'),
            'price' => Yii::t('estoreadmin', 'Price'),
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
        return [];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'article_id' => ['class' => SelectRelationActiveQuery::class, 'query' => $this->getArticle(), 'labelField' => ['name'], 'asyncList' => true],
            'currency_id' => ['class' => SelectRelationActiveQuery::class, 'query' => $this->getCurrency(), 'labelField' => ['name'], 'asyncList' => true],
            'qty' => 'number',
            'price' => 'decimal',
        ];
    }
    
    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
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
            ['list', ['article_id', 'currency_id', 'price']],
            [['create', 'update'], ['article_id', 'currency_id', 'qty', 'price']],
            ['delete', false],
        ];
    }
}
