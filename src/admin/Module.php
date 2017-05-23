<?php

namespace luya\estore\admin;

/**
 * Estore Admin Module.
 *
 * File has been created with `module/create` command on LUYA version 1.0.0-dev.
 */
class Module extends \luya\admin\base\Module
{
    public $apis = [
        'api-estore-group' => 'luya\estore\admin\apis\GroupController',
        'api-estore-product' => 'luya\estore\admin\apis\ProductController',
        'api-estore-set' => 'luya\estore\admin\apis\SetController',
        'api-estore-setattribute' => 'luya\estore\admin\apis\SetAttributeController',
        'api-estore-article' => 'luya\estore\admin\apis\ArticleController',
        'api-estore-articleprice' => 'luya\estore\admin\apis\ArticlePriceController',
        'api-estore-currency' => 'luya\estore\admin\apis\CurrencyController',
        'api-estore-producer' => 'luya\estore\admin\apis\ProducerController',
        
    ];
    
    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
        ->node('E-Store', 'store_mall_directory')
            ->group('Products')
                ->itemApi('Groups', 'estoreadmin/group/index', 'folder', 'api-estore-group')
                ->itemApi('Products', 'estoreadmin/product/index', 'library_books', 'api-estore-product')
                ->itemApi('Articles', 'estoreadmin/article/index', 'list', 'api-estore-article')
                ->itemApi('Prices', 'estoreadmin/article-price/index', 'adjust', 'api-estore-articleprice')
            ->group('Settings')
                ->itemApi('Currencies', 'estoreadmin/currency/index', 'attach_money', 'api-estore-currency')
                ->itemApi('Producers', 'estoreadmin/producer/index', 'domain', 'api-estore-producer')
            ->group('Sets')
                ->itemApi('Sets', 'estoreadmin/set/index', 'web_asset', 'api-estore-set')
                ->itemApi('Attributes', 'estoreadmin/set-attribute/index', 'check_box', 'api-estore-setattribute');
    }
    
    public function getAdminAssets()
    {
        return [
            'luya\estore\admin\assets\EstoreAdminAsset',
        ];
    }
}
