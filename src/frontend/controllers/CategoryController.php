<?php

namespace luya\estore\frontend\controllers;

use luya\estore\models\Group;
use luya\estore\models\Product;
use luya\web\Controller;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function createAction($id)
    {
        if (preg_match('/^[a-z0-9\\-_]+$/', $id) && strpos($id, '--') === false && trim($id, '-') === $id) {
            $categoryName = preg_replace('#[ -_]#', '', $id);
            $category = Group::find()->where(['code' => $categoryName])->one();
            if ($category) {
                return new CategoryAction($id, $this, 'actionIndex', $category);
            }
        }
        
        return parent::createAction($id);
    }
    
    public function actionIndex($category)
    {
        return $this->render('view', [
            'model' => $category,
        ]);
    }
}