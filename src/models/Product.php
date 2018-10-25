<?php

namespace luya\estore\models;

use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;
use luya\estore\admin\plugins\ProductAttributesPlugin;
use luya\estore\models\queries\ProductQuery;
use luya\helpers\Json;
use Yii;

/**
 * Product.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property integer   $id
 * @property string    $name
 * @property integer   $producer_id
 * @property integer   $visibility
 * @property bool      $enabled
 *
 * @property Product[] $products
 * @property Group[]   $groups
 * @property Set[]     $sets
 */
class Product extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['name'];
    
    /**
     * @var array
     */
    public $adminGroups = [];
    
    /**
     * @var array
     */
    public $adminSets = [];
    
    private $_data = null;
    
    private $_values = null;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_product';
    }
    
    public static function find()
    {
        $query = new ProductQuery(get_called_class());
        
        //$query->joinWith('sets');
        
        return $query;
    }
    
    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-product';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('estoreadmin', 'ID'),
            'name' => Yii::t('estoreadmin', 'Name'),
            'producer_id' => Yii::t('estoreadmin', 'Producer ID'),
            'adminGroups' => Yii::t('estoreadmin', 'Categories'),
            'adminSets' => Yii::t('estoreadmin', 'Attribute Sets'),
            'visibility' => Yii::t('estoreadmin', 'Visibility'),
            'enabled' => Yii::t('estoreadmin', 'Enabled'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'producer_id'], 'required'],
            [['name'], 'string'],
            [['sku'], 'string', 'max' => 255],
            [['sku'], 'unique'],
            [['producer_id', 'visibility'], 'integer'],
            [['enabled'], 'boolean'],
            [['adminGroups', 'adminSets', 'values'], 'safe'],
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
            'id' => 'number',
            'name' => 'text',
            'producer_id' => ['selectModel', 'modelClass' => Producer::class],
            'visibility' => [
                'selectArray',
                'initValue' => 1,
                'data' => [
                    0 => Yii::t('estoreadmin', 'Not visible'),
                    1 => Yii::t('estoreadmin', 'Anywhere'),
                    2 => Yii::t('estoreadmin', 'Category'),
                    3 => Yii::t('estoreadmin', 'Search'),
                ],
            ],
            'enabled' => 'toggleStatus',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['name', 'producer_id', 'visibility', 'enabled']],
            [['create', 'update'], ['name', 'producer_id', 'adminGroups', 'adminSets', 'values', 'visibility', 'enabled']],
            ['delete', false],
        ];
    }
    
    public function ngRestExtraAttributeTypes()
    {
        return [
            'adminGroups' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getGroups(),
                'labelField' => ['name'],
            ],
            'adminSets' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getSets(),
                'labelField' => ['name'],
            ],
            'values' => [
                'class' => ProductAttributesPlugin::class,
            ],
        ];
    }
    
    public function ngRestRelations()
    {
        return [
            ['label' => 'Products', 'apiEndpoint' => Product::ngRestApiEndpoint(), 'dataProvider' => $this->getproducts()],
        ];
    }
    
    public function extraFields()
    {
        return ['adminGroups', 'adminSets', 'values'];
    }
    
    /**
     * Attach the set behaviors
     */
    public function afterFind()
    {
        foreach ($this->sets as $set) {
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
                $model = new ProductAttributeValue();
                $model->attribute_id = $attributeId;
                $model->value = Json::encode($attributeValue);
                $model->set_id = $setId;
                $this->link('attributeValues', $model);
            }
        }
    }
    
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['product_id' => 'id']);
    }
    
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable(ProductGroupRef::tableName(), ['product_id' => 'id']);
    }
    
    public function getSets()
    {
        return $this->hasMany(Set::class, ['id' => 'set_id'])->viaTable(ProductSetRef::tableName(), ['product_id' => 'id']);
    }
    
    public function getAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::class, ['product_id' => 'id'])->joinWith('setAttribute');
    }
    
    public function getPrices()
    {
        return $this->hasMany(ProductPrice::class, ['product_id' => 'id']);
    }
}
