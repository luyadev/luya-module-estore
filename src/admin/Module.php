<?php

namespace luya\estore\admin;

use luya\console\interfaces\ImportControllerInterface;
use luya\estore\models\Config;

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
        'api-estore-productprice' => 'luya\estore\admin\apis\ProductPriceController',
        'api-estore-currency' => 'luya\estore\admin\apis\CurrencyController',
        'api-estore-producer' => 'luya\estore\admin\apis\ProducerController',
        'api-estore-config' => 'luya\estore\admin\apis\ConfigController',
    ];
    
    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
        ->node('E-Store', 'store_mall_directory')
            ->group('Products')
                ->itemApi('Groups', 'estoreadmin/group/index', 'folder', 'api-estore-group')
                ->itemApi('Products', 'estoreadmin/product/index', 'library_books', 'api-estore-product')
                ->itemApi('Prices', 'estoreadmin/product-price/index', 'adjust', 'api-estore-productprice')
            ->group('Settings')
                ->itemApi('Currencies', 'estoreadmin/currency/index', 'attach_money', 'api-estore-currency')
                ->itemApi('Producers', 'estoreadmin/producer/index', 'domain', 'api-estore-producer')
                ->itemApi('Config', 'estoreadmin/config/index', 'build', 'api-estore-config')

            ->group('Sets')
                ->itemApi('Sets', 'estoreadmin/set/index', 'web_asset', 'api-estore-set')
                ->itemApi('Attributes', 'estoreadmin/set-attribute/index', 'check_box', 'api-estore-setattribute');
    }

    /**
     * @inheritdoc
     */
    public function import(ImportControllerInterface $importer)
    {
        if (!Config::has(Config::PLACEHOLDER_IMAGE)) {
            Config::set(Config::PLACEHOLDER_IMAGE, '');
        }

        return parent::import($importer);
    }

    public function getAdminAssets()
    {
        return [
            'luya\estore\admin\assets\EstoreAdminAsset',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function onLoad()
    {
        self::registerTranslation('estoreadmin*', static::staticBasePath() . '/messages', [
            'estoreadmin' => 'estoreadmin.php',
        ]);
    }

    /**
     * Translations for CMS admin Module.
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('estoreadmin', $message, $params);
    }
}
