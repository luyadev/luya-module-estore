<?php

namespace luya\estore\models\behaviors;

use luya\admin\image\Item;
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
    private function getImage($type)
    {
        $image = Yii::$app->storage->getImage($this->owner->getData($type));

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
        $image = $this->getImage('small_image');
        if (!$image) {
            return false;
        }
    
        return $image->applyFilter(\luya\admin\filters\MediumThumbnail::identifier());
    }

    public function getThumbnail()
    {
        $image = $this->getImage('thumbnail');
        if (!$image) {
            return false;
        }
    
        return $image->applyFilter(\luya\admin\filters\SmallCrop::identifier());
    }
}