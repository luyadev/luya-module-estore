<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\estore\admin\plugins\ArticleAttributesPlugin;
use luya\estore\models\ArticleAttributeValue;

/**
 * Article.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property \luya\estore\models\Product $product
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
            [['values'], 'safe']
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

    public function ngRestExtraAttributeTypes()
    {
        return [
            'values' => [
                'class' => ArticleAttributesPlugin::class,
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['product_id', 'name', 'sku', 'qty_available']],
            [['create', 'update'], ['product_id', 'name', 'sku', 'qty_available', 'values']],
            ['delete', false],
        ];
    }
    
    public function ngRestRelations()
    {
        return [
            ['label' => 'Prices', 'apiEndpoint' => ArticlePrice::ngRestApiEndpoint(), 'dataProvider' => $this->getPrices()],
        ];
    }
    
    public function extraFields()
    {
        return ['values'];
    }
    
    public function getAttributeValues()
    {
        return $this->hasMany(ArticleAttributeValue::class, ['article_id' => 'id']);
    }
    
    public function getValues()
    {
        $data = [];
        foreach ($this->attributeValues as $value) {
            $data[$value->set_id][$value->attribute_id] = $value->value;
        }
        
        return $data;
    }
    
    public function setValues($data)
    {
        if ($this->isNewRecord) {
            $this->on(self::EVENT_AFTER_INSERT, function () use ($data) {
                $this->updateSetValues($data);
            });
        } else {
            $this->updateSetValues($data);
        }
    }
    
    private function updateSetValues($data)
    {
        $this->unlinkAll('attributeValues', true);
        foreach ($data as $setId => $values) {
            foreach ($values as $attributeId => $attributeValue) {
                $model = new ArticleAttributeValue();
                $model->attribute_id = $attributeId;
                $model->value = $attributeValue;
                $model->set_id = $setId;
                $this->link('attributeValues', $model);
            }
        }
    }
    
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getPrices()
    {
        return $this->hasMany(ArticlePrice::class, ['article_id' => 'id']);
    }
}
