<?php

namespace luya\estore\models;

use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;
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
 * @property Article[] $articles
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
            [['producer_id', 'visibility'], 'integer'],
            [['enabled'], 'boolean'],
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
            [['create', 'update'], ['name', 'producer_id', 'adminGroups', 'adminSets', 'visibility', 'enabled']],
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
        ];
    }

    public function ngRestRelations()
    {
        return [
            ['label' => 'Articles', 'apiEndpoint' => Article::ngRestApiEndpoint(), 'dataProvider' => $this->getArticles()],
        ];
    }

    public function extraFields()
    {
        return ['adminGroups', 'adminSets'];
    }
    
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['product_id' => 'id']);
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
