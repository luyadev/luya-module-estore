<?php

namespace luya\estore\frontend\blocks;

use luya\admin\base\TypesInterface;
use luya\cms\base\PhpBlock;
use luya\cms\helpers\BlockHelper;
use luya\estore\frontend\blockgroups\EStoreGroup;
use luya\estore\models\Group;
use luya\estore\models\Product;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * Product List Block.
 *
 * File has been created with `block/create` command. 
 */
class ProductListBlock extends PhpBlock
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

    private $_categories;

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
        return 'Product List Block';
    }
    
    /**
     * @inheritDoc
     */
    public function icon()
    {
        return 'extension'; // see the list of icons on: https://design.google.com/icons/
    }

    public function renderAdmin()
    {
        $this->_categories = [];

        foreach (Group::find()->all() as $group) {
            $this->_categories[] = ['value' => $group->id, 'label' => $group->name];
        }

        return parent::renderAdmin();
    }

    /**
     * @inheritDoc
     */
    public function config()
    {
        return [
            'vars' => [
                 ['var' => 'category', 'label' => 'Category', 'type' => TypesInterface::TYPE_SELECT, 'options' => $this->_categories],
            ],
            'cfgs' => [
                ['var' => 'pageSize', 'label' => 'Page size', 'type' => TypesInterface::TYPE_NUMBER, 'initvalue' => 10],
                ['var' => 'pageSizeLimit', 'label' => 'Pages', 'type' => TypesInterface::TYPE_NUMBER, 'initvalue' => 4],
            ],
        ];
    }

    public function extraVars()
    {
        return [
            'dataProvider' => new ActiveDataProvider([
                'query' => $this->createQuery(),
                'pagination' => [
                    'pageSize' => $this->getCfgValue('pageSize'),
                    'pageSizeLimit' => $this->getCfgValue('pageSizeLimit'),
                ],
            ]),
        ];
    }

    /**
     * {@inheritDoc} 
     *
     * @param {{cfgs.limit}}
     * @param {{cfgs.pageSize}}
     * @param {{vars.category}}
    */
    public function admin()
    {
        return '<h5 class="mb-3">Product List Block</h5>' .
            '<table class="table table-bordered">' .
            '{% if vars.category is not empty %}' .
            '<tr><td><b>Category</b></td><td>{{vars.category}}</td></tr>' .
            '{% endif %}'.
            '{% if cfgs.limit is not empty %}' .
            '<tr><td><b>Limit</b></td><td>{{cfgs.limit}}</td></tr>' .
            '{% endif %}'.
            '{% if cfgs.pageSize is not empty %}' .
            '<tr><td><b>Page size</b></td><td>{{cfgs.pageSize}}</td></tr>' .
            '{% endif %}'.
            '{% if cfgs.pageSizeLimit is not empty %}' .
            '<tr><td><b>Page size limit</b></td><td>{{cfgs.pageSizeLimit}}</td></tr>' .
            '{% endif %}'.
            '</table>';
    }

    /**
     * @return Query
     */
    private function createQuery()
    {
        return Product::find()->actives()->category($this->getVarValue('category'));
    }
}