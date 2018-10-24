<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Currency.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property integer $id
 * @property bool $is_base
 * @property string $iso
 * @property string $name
 * @property float $value
 */
class Currency extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['name'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_currency';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-currency';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('estoreadmin', 'ID'),
            'is_base' => Yii::t('estoreadmin', 'Is Base'),
            'iso' => Yii::t('estoreadmin', 'ISO'),
            'name' => Yii::t('estoreadmin', 'Name'),
            'value' => Yii::t('estoreadmin', 'Value'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_base'], 'integer'],
            [['iso', 'name', 'value'], 'required'],
            [['value'], 'number'],
            [['iso'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['iso', 'name'];
    }

    public function ngRestListOrder()
    {
        return ['iso' => SORT_ASC];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'is_base' => 'toggleStatus',
            'iso' => 'text',
            'name' => 'text',
            'value' => 'decimal',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['is_base', 'iso', 'name', 'value']],
            [['create', 'update'], ['is_base', 'iso', 'name', 'value']],
            ['delete', false],
        ];
    }
}
