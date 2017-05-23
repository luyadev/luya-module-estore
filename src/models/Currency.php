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
 * @property smallint $is_base
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
            'id' => Yii::t('app', 'ID'),
            'is_base' => Yii::t('app', 'Is Base'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_base'], 'integer'],
            [['name', 'value'], 'required'],
            [['value'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'is_base' => 'toggleStatus',
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
            ['list', ['is_base', 'name', 'value']],
            [['create', 'update'], ['is_base', 'name', 'value']],
            ['delete', false],
        ];
    }
}
