<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;
use luya\admin\ngrest\plugins\SelectArray;
use luya\admin\base\TypesInterface;
use yii\helpers\Json;

/**
 * Set Attribute.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property integer $id
 * @property integer $type
 * @property string $input
 * @property string $name
 * @property string $values
 * @property integer $is_i18n
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
            [['type', 'is_i18n'], 'integer'],
            [['input', 'name'], 'required'],
            [['values'], 'string'],
            [['input', 'name'], 'string', 'max' => 255],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['values_json'] = function ($model) {
            return Json::decode($model->values);
        };
        return $fields;
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
            'values' => 'html',
            'is_i18n' => 'toggleStatus',
            'input' => ['selectArray', 'data' => [
                TypesInterface::TYPE_TEXT => 'text',
                TypesInterface::TYPE_TEXTAREA => 'textarea',
                TypesInterface::TYPE_CHECKBOX => 'checkbox',
                TypesInterface::TYPE_SELECT => 'select',
            ]]
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['type', 'name', 'values']],
            [['create', 'update'], ['type', 'name', 'values', 'is_i18n', 'input']],
            ['delete', false],
        ];
    }
}
