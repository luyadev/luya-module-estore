<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\SelectArray;

/**
 * Set Attribute.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property text $values
 */
class SetAttribute extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['name', 'values'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_set_attribute';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-setattribute';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'values' => Yii::t('app', 'Values'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name'], 'required'],
            [['values'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['name', 'values'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'type' => [
                'class' => SelectArray::class,
                'data' => [1 => 'Integer', 2 => 'Boolean', 3  => 'String'],
            ],
            'name' => 'text',
            'values' => 'textarea',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['type', 'name', 'values']],
            [['create', 'update'], ['type', 'name', 'values']],
            ['delete', false],
        ];
    }
}