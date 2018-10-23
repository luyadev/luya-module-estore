<?php

use luya\admin\base\TypesInterface;
use luya\estore\models\Set;
use luya\estore\models\SetAttribute;
use luya\estore\models\SetAttributeRef;
use luya\helpers\Json;
use yii\db\Migration;
use yii\db\Query;

/**
 * Class m181018_204140_baseattributes
 */
class m181018_204140_baseattributes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            SetAttribute::tableName(),
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

                ['url_key', '{"en": "Url key", "de": "URL Schlüssel"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['country_of_manufacture', '{"en": "Country of manufacture", "de": "Herstellerland"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['manufacturer', '{"en": "Manufacturer", "de": "Hersteller"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],

                ['meta_description', '{"en": "SEO description", "de": "SEO Beschreibung"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['meta_keyword', '{"en": "SEO keywords", "de": "Seo Keywords"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
                ['meta_title', '{"en": "SEO title", "de": "SEO Titel"}', SetAttribute::TYPE_STRING, TypesInterface::TYPE_TEXT, null],
            ]);

        $set = new Set();
        $set->code = 'default';
        $set->name = '{"en": "Default", "de": "Standard"}';
        $set->save();

        $defaultSetAttributes = (new Query())->from(SetAttribute::tableName())->select(['set_id' => new \yii\db\Expression($set->id), 'attribute_id' => 'id'])->all();

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
        $setId = (new Query())->from(Set::tableName())->select('id')->where(['code' => 'default'])->scalar();
        $attributeIds = (new Query())->from(SetAttributeRef::tableName())->select('attribute_id')->where(['set_id' => $setId])->column();

        $this->delete(Set::tableName(), ['id' => $setId]);
        $this->delete(SetAttributeRef::tableName(), ['set_id' => $setId]);
        $this->delete(SetAttribute::tableName(), ['id' => $attributeIds]);

        return true;
    }
}
