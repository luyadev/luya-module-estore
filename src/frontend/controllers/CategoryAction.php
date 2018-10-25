<?php

namespace luya\estore\frontend\controllers;

class CategoryAction extends \yii\base\InlineAction
{
    public $category;
    
    public function __construct(string $id, \yii\web\Controller $controller, string $actionMethod, \luya\estore\models\Group $category, array $config = [])
    {
        $this->category = $category;
        
        parent::__construct($id, $controller, $actionMethod, $config);
    }
    
    public function runWithParams($params)
    {
        $params['category'] = $this->category;
        
        return parent::runWithParams($params);
    }
    
}