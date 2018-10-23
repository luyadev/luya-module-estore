<?php

namespace luya\estore\admin\controllers;

/**
 * Config Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class ConfigController extends \luya\admin\ngrest\base\Controller
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'luya\estore\models\Config';
}