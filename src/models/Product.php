<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;

/**
 * Product.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 *
 * @property integer $id
 * @property text $name
 * @property integer $producer_id
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
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_product';
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'producer_id' => Yii::t('app', 'Producer ID'),
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
            [['producer_id'], 'integer'],
            [['adminGroups', 'adminSets'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['name'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'name' => 'text',
            'producer_id' => ['selectModel', 'modelClass' => Producer::class],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['name', 'producer_id']],
            [['create', 'update'], ['name', 'producer_id', 'adminGroups', 'adminSets']],
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
            ]
        ];
    }
    
    public function extraFields()
    {
        return ['adminGroups', 'adminSets'];
    }
    
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable(ProductGroupRef::tableName(), ['product_id' => 'id']);
    }
    
    public function getSets()
    {
        return $this->hasMany(Set::class, ['id' => 'set_id'])->viaTable(ProductSetRef::tableName(), ['product_id' => 'id']);
    }
}