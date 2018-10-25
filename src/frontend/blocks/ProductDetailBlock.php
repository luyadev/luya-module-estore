<?php

namespace luya\estore\frontend\blocks;

use luya\cms\base\PhpBlock;
use luya\cms\frontend\blockgroups\ProjectGroup;
use luya\cms\helpers\BlockHelper;
use luya\estore\frontend\blockgroups\EStoreGroup;

/**
 * Product Detail Block.
 *
 * File has been created with `block/create` command. 
 */
class ProductDetailBlock extends PhpBlock
{
    /**
     * @var string The module where this block belongs to in order to find the view files.
     */
    public $module = 'estore';

    /**
     * @var bool Choose whether a block can be cached trough the caching component. Be carefull with caching container blocks.
     */
    public $cacheEnabled = true;
    
    /**
     * @var int The cache lifetime for this block in seconds (3600 = 1 hour), only affects when cacheEnabled is true
     */
    public $cacheExpiration = 3600;

    /**
     * @inheritDoc
     */
    public function blockGroup()
    {
        return EStoreGroup::class;
    }

    /**
     * @inheritDoc
     */
    public function name()
    {
        return 'Product Detail Block';
    }
    
    /**
     * @inheritDoc
     */
    public function icon()
    {
        return 'extension'; // see the list of icons on: https://design.google.com/icons/
    }
 
    /**
     * @inheritDoc
     */
    public function config()
    {
        return [
        ];
    }
    
    /**
     * {@inheritDoc} 
     *
    */
    public function admin()
    {
        return '<h5 class="mb-3">Product Detail Block</h5>' .
            '<table class="table table-bordered">' .
            '</table>';
    }
}