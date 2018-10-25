<?php

namespace luya\estore\frontend\controllers;

use luya\estore\models\Product;
use luya\web\Controller;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    public function actionView($id)
    {
        $model = Product::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}