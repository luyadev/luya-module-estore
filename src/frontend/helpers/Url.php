<?php

namespace luya\estore\frontend\helpers;

use luya\estore\models\Product;

class Url extends \luya\helpers\Url
{
    public static function toProduct(Product $product)
    {
        return self::toRoute(['/estore/product/view', 'id' => $product->id]);
    }
}