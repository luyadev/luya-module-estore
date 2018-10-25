<?php

namespace luya\estore\admin\plugins;

use luya\admin\ngrest\base\Plugin;

class ProductAttributesPlugin extends Plugin
{
    public function renderList($id, $ngModel)
    {
        return $this->createListTag($ngModel);
    }
    
    public function renderCreate($id, $ngModel)
    {
        return $this->createFormTag('estore-attributes', $id, $ngModel, []);
    }
    
    public function renderUpdate($id, $ngModel)
    {
        return $this->createFormTag('estore-attributes', $id, $ngModel, ['product' => 'data.updateId']);
    }
}
