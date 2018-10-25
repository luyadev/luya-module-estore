<?php

namespace luya\estore\admin\controllers;

/**
 * Product Controller.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 */
class ProductController extends \luya\admin\ngrest\base\Controller
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'luya\estore\models\Product';
    
    public function actionProductAttributes()
    {
        return $this->render('productattribute');
    }
}
