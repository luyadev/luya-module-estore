<?php

namespace luya\estore\models;

use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Group.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 *
 * @property integer $id
 * @property integer $parent_group_id
 * @property integer $cover_image_id
 * @property string $images_list
 * @property string $name
 * @property string $teaser
 * @property string $text
 */
class Group extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['images_list', 'name', 'teaser', 'text'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estore_group';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-estore-group';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('estoreadmin', 'ID'),
            'parent_group_id' => Yii::t('estoreadmin', 'Parent Group ID'),
            'cover_image_id' => Yii::t('estoreadmin', 'Cover Image ID'),
            'images_list' => Yii::t('estoreadmin', 'Images List'),
            'name' => Yii::t('estoreadmin', 'Name'),
            'teaser' => Yii::t('estoreadmin', 'Teaser'),
            'text' => Yii::t('estoreadmin', 'Text'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_group_id', 'cover_image_id'], 'integer'],
            [['images_list', 'name', 'teaser', 'text'], 'string'],
            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['images_list', 'name', 'teaser', 'text'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'parent_group_id' => 'number',
            'cover_image_id' => 'image',
            'images_list' => 'imageArray',
            'name' => 'text',
            'teaser' => 'text',
            'text' => 'textarea',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['parent_group_id', 'cover_image_id', 'images_list', 'name', 'teaser', 'text']],
            [['create', 'update'], ['parent_group_id', 'cover_image_id', 'images_list', 'name', 'teaser', 'text']],
            ['delete', false],
        ];
    }
}
