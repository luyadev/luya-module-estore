<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\CheckboxRelationActiveQuery;

/**
 * Set.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property \luya\estore\models\SetAttribute $setAttributes
 * @property integer $id
 * @property string $name
 */
class Set extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['name'];

    /**
     *
     * @var array
     */
    public $adminSetAttributes = [];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_set';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-set';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['adminSetAttributes'], 'safe'],
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['name']],
            [['create', 'update'], ['name', 'adminSetAttributes']],
            ['delete', false],
        ];
    }

    public function ngRestExtraAttributeTypes()
    {
        return [
            'adminSetAttributes' => [
                'class' => CheckboxRelationActiveQuery::class,
                'query' => $this->getSetAttributes(),
                'labelField' => ['name']
            ]
        ];
    }

    public function extraFields()
    {
        return ['adminSetAttributes'];
    }
    
    public function getSetAttributes()
    {
        return $this->hasMany(SetAttribute::class, ['id' => 'attribute_id'])->viaTable(SetAttributeRef::tableName(), ['set_id' => 'id']);
    }
}
