<?php

namespace luya\estore\models\behaviors;

use luya\estore\models\Article;
use Yii;
use luya\estore\models\Config;
use luya\estore\models\Product;
use yii\base\Behavior;

/**
 * Class DefaultSet
 *
 * @author Bennet Klarhoelter <boehsermoe@me.com>
 *
 * @property Product|Article $owner
 */
class DefaultSet extends Behavior
{
    /**
     * @return bool|\luya\admin\image\Item
     */
    private function getImage($code)
    {
        $image = Yii::$app->storage->getImage($this->owner->getData($code));

        if (!$image) {
            $image = Yii::$app->storage->getImage(Config::get(Config::PLACEHOLDER_IMAGE));
        }

        return $image;
    }

    public function getBaseImage()
    {
        return $this->getImage('base_image');
    }

    public function getSmallImage()
    {
        return $this->getImage('small_image')->applyFilter(\luya\admin\filters\MediumThumbnail::identifier());
    }

    public function getThumbnail()
    {
        return $this->getImage('thumbnail')->applyFilter(\luya\admin\filters\SmallCrop::identifier());
    }
}