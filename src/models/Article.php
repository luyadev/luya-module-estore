<?php

namespace luya\estore\models;

use luya\helpers\Json;
use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\estore\admin\plugins\ArticleAttributesPlugin;

/**
 * Article.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property \luya\estore\models\Product $product
 * @property \luya\estore\models\ArticleAttributeValue[] $attributeValues
 * @property integer $id
 * @property integer $product_id
 * @property string $name
 * @property string $sku
 * @property integer $qty_available
 * @property bool $enabled
 */
class Article extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['name', 'sku'];

    private $_data = null;

    private $_values = null;

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
            'id' => Yii::t('estoreadmin', 'ID'),
            'product_id' => Yii::t('estoreadmin', 'Product ID'),
            'name' => Yii::t('estoreadmin', 'Name'),
            'sku' => Yii::t('estoreadmin', 'Sku'),
            'qty_available' => Yii::t('estoreadmin', 'Qty Available'),
            'enabled' => Yii::t('estoreadmin', 'Enabled'),
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
            [['sku'], 'unique'],
            [['enabled'], 'boolean'],
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
            'product_id' => ['selectModel', 'modelClass' => Product::class, 'labelField' => ['name']],
            'name' => 'text',
            'sku' => 'text',
            'qty_available' => 'number',
            'enabled' => 'toggleStatus',
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
            ['list', ['product_id', 'name', 'sku', 'qty_available', 'enabled']],
            [['create', 'update'], ['product_id', 'name', 'sku', 'qty_available', 'enabled', 'values']],
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
        return $this->hasMany(ArticleAttributeValue::class, ['article_id' => 'id'])->joinWith('setAttribute');
    }

    /**
     * Attach the set behaviors
     */
    public function afterFind()
    {
        foreach ($this->product->sets as $set) {
            $setBehaviorClass = __NAMESPACE__ . '\\behaviors\\' . $set->name . 'Set';
            if (class_exists($setBehaviorClass)) {
                $this->attachBehavior($set->name . 'Set', $setBehaviorClass);
            }
        }

        return parent::afterFind();
    }

    /**
     * {@inheritdoc}
     *
     * @param $record self
     */
    public static function populateRecord($record, $row)
    {
        parent::populateRecord($record, $row);

        $record->_values = [];
        $record->_data = [];

        foreach ($record->attributeValues as $attributeValue) {
            $value = Json::decode($attributeValue->value);
            $record->_values[$attributeValue->set_id][$attributeValue->attribute_id] = $value;
            $record->_data[$attributeValue->setAttribute->code] = $value;
        }
    }

    public function __get($name)
    {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }

        return parent::__get($name);
    }

    public function getData($code = null)
    {
        if ($code != null) {
            return $this->_data[$code];
        }

        return $this->_data;
    }

    public function getValues()
    {
        return $this->_values;
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
                $model->value = Json::encode($attributeValue);
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
