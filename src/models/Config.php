<?php

namespace luya\estore\models;

use Yii;
use luya\admin\base\TypesInterface;
use luya\admin\ngrest\base\NgRestModel;
use luya\traits\RegistryTrait;

/**
 * This is the model class for table "cms_config".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $value
 *
 * @author Bennet Klarhoelter <boehsermoe@me.com>
 * @since 1.0.0
 */
class Config extends NgRestModel
{
    use RegistryTrait;

    const PLACEHOLDER_IMAGE = 'placeholder_image';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_config';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['value'], 'required', 'strict' => true],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'name' => 'Name',
            'type' => 'Type',
            'value' => 'Value',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'name' => 'text',
            'type' => ['selectArray', 'data' => [
                TypesInterface::TYPE_TEXT => Yii::t('app', 'Text'),
                TypesInterface::TYPE_DECIMAL => Yii::t('app', 'Decimal'),
                TypesInterface::TYPE_SELECT => Yii::t('app', 'Select'),
                TypesInterface::TYPE_CHECKBOX => Yii::t('app', 'Checkbox'),
                TypesInterface::TYPE_DATETIME => Yii::t('app', 'Datetime'),
                TypesInterface::TYPE_IMAGEUPLOAD => Yii::t('app', 'Image'),
                TypesInterface::TYPE_CMS_PAGE => Yii::t('app', 'CMS Page'),
                TypesInterface::TYPE_FILEUPLOAD => Yii::t('app', 'File'),
                TypesInterface::TYPE_LINK => Yii::t('app', 'Link'),
            ]],
            'value' => ['injector', 'attribute' => 'type'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            [['list'], ['name', 'value']],
            [['update'], ['name', 'value', 'type']],
            [['delete'], false],
        ];
    }
}
