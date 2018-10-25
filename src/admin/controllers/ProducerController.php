<?php

namespace luya\estore\admin\controllers;

/**
 * Producer Controller.
 *
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev.
 */
class ProducerController extends \luya\admin\ngrest\base\Controller
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'luya\estore\models\Producer';
    
    public function actionProductAttributes()
    {
        return $this->render('productattribute');
    }
}
