<?php

namespace luya\estore\admin\apis;

/**
 * Product Controller.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0-dev. 
 */
class ProductController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'luya\estore\models\Product';
    
    
    /**
     *
     * @param unknown $id
     * @return unknown
     */
    public function actionAttributes($id)
    {
        $model = $this->findModel($id);
        
        $data = [];
        
        foreach ($model->getSets()->with(['setAttributes'])->all() as $set) {
            $data[] = [
                'set' => $set,
                'attributes' => $set->setAttributes,
            ];
        }
        
        return $data;
    }
}