<?php

namespace luya\estore\admin\apis;

/**
 * Config Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class ConfigController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'luya\estore\models\Config';
}