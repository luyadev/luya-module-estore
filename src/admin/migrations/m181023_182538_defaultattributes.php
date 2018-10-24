<?php

use yii\db\Migration;
use yii\db\Query;
use luya\estore\models\SetAttributeRef;
use luya\estore\models\Set;
use luya\estore\models\SetAttribute;
use luya\admin\base\TypesInterface;
use luya\helpers\Json;

/**
 * Class m181023_182538_defaultattributes
 */
class m181023_182538_defaultattributes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            '{{%estore_set_attribute}}',
            ['code', 'name', 'type', 'input', 'values'],
            [
                [
                    'deliver_time',
                    '{"en": "Deliver time", "de": "Lieferzeit"}',
                    SetAttribute::TYPE_STRING,
                    TypesInterface::TYPE_SELECT,
                    Json::encode([ 'en' => Json::encode([["label" => "1 day", "value" => 1], ["label" => "2 day", "value" => 2], ["label" => "3 day", "value" => 3]]) ]),
                ],
                ['description', '{"en": "Description", "de": "Beschreibung"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['short_description', '{"en": "Short description", "de": "Kurzbeschreibung"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],

                ['gallery', '{"en": "Gallery", "de": "Gallerie"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_IMAGEUPLOAD_ARRAY, null],
                ['base_image', '{"en": "Base image", "de": "Bild"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_IMAGEUPLOAD, null],
                ['thumbnail', '{"en": "Thumbnail", "de": "Vorschau"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_IMAGEUPLOAD, null],
                ['small_image', '{"en": "Small image", "de": "Bild (klein)"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_IMAGEUPLOAD, null],

                ['special_from_date', '{"en": "Special from", "de": "Angebot ab"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_DATETIME, null],
                ['special_to_date', '{"en": "Special to", "de": "Angebot bis"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_DATETIME, null],
                ['special_price', '{"en": "Special price", "de": "Angebotspreis"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_DECIMAL, null],

                ['country_of_manufacture', '{"en": "Country of manufacture", "de": "Herstellerland"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['manufacturer', '{"en": "Manufacturer", "de": "Hersteller"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],

                ['meta_description', '{"en": "SEO description", "de": "SEO Beschreibung"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['meta_keyword', '{"en": "SEO keywords", "de": "Seo Keywords"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['meta_title', '{"en": "SEO title", "de": "SEO Titel"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
            ]);

        $this->insert('{{%estore_set}}', [
            'code' => 'default',
            'name' => '{"en": "Default", "de": "Standard"}',
        ]);
        $setId = (new Query())->from('{{%estore_set}}')->select('id')->where(['code' => 'default'])->scalar();

        $defaultSetAttributes = (new Query())->from('{{%estore_set_attribute}}')->select(['set_id' => new \yii\db\Expression($setId), 'attribute_id' => 'id'])->all();

        $this->batchInsert(
            SetAttributeRef::tableName(),
            ['set_id', 'attribute_id'],
            $defaultSetAttributes
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $setId = (new Query())->from('{{%estore_set}}')->select('id')->where(['code' => 'default'])->scalar();
        $attributeIds = (new Query())->from('{{%estore_set_attribute_ref}}')->select('attribute_id')->where(['set_id' => $setId])->column();

        $this->delete('{{%estore_set}}', ['id' => $setId]);
        $this->delete('{{%estore_set_attribute_ref}}', ['set_id' => $setId]);
        $this->delete('{{%estore_set_attribute}}', ['id' => $attributeIds]);

        return true;
    }
}
