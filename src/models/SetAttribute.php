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
 * @property string $code
 * @property string $name
 * @property string $values
 * @property integer $is_i18n
 */
class SetAttribute extends NgRestModel
{
    const TYPE_INTEGER = 1;
    const TYPE_BOOLEAN = 2;
    const TYPE_STRING = 3;

    /**
     * @inheritdoc
     */
    public $i18n = ['name', 'values'];
    
    /**
     * @inheritdoc
     */
    const C = 1;

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
            'id' => Yii::t('estoreadmin', 'ID'),
            'type' => Yii::t('estoreadmin', 'Type'),
            'code' => Yii::t('estoreadmin', 'Code'),
            'name' => Yii::t('estoreadmin', 'Name'),
            'values' => Yii::t('estoreadmin', 'Values'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'is_i18n'], 'integer'],
            [['input', 'code', 'name'], 'required'],
            [['values'], 'string'],
            [['input', 'code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields['values_json'] = function (SetAttribute $model) {
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
                'data' => [self::TYPE_INTEGER => 'Integer', self::TYPE_BOOLEAN => 'Boolean', self::TYPE_STRING => 'String'],
            ],
            'code' => 'text',
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
            ['list', ['type', 'code', 'name', 'values']],
            [['create', 'update'], ['type', 'code', 'name', 'values', 'is_i18n', 'input']],
            ['delete', false],
        ];
    }
}
