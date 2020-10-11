# E-STORE MODULE

**Work in Progress - don't use in Production**

Connect the E-Store module to an existing LUYA Instance with or without CMS. The E-Store Module basically provides the Administration Area and the Database Setup. For the Frontend there are some usefull widgets you can use.

*For now, you have to create your own controllers and actions in order to access, list or display the models*

Things to consider in future development:

+ VAT
+ Frontend Controllers
+ Frontend Widgets
+ Mechanism to get all Article Groups
+ Language handling based on Admin Ui Language Input.

## Installation

Install the module trough composer:

```
compser require luyadev/luya-module-estore:dev-master
```

Add the module to the config

```php
'modules' => [
    'estoreadmin' => [
        'class' => 'luya\estore\admin\Module',
    ]
]
```

Run the migration and import commands:

```sh
./vendor/bin/luya migrate
```

```sh
./vendor/bin/luya import
```

Go into the groups section and assign the new estore admin permissions to your account. You should now be able to see the administration area.

## Controllers and Frontend

Until now this work in progress Module contains only the admin area with all migrations and models. In order to display the products you have to create your own controllers, actions and views:

```php
namespace app\controllers;

use luya\web\Controller;
use yii\data\ActiveDataProvider;
use luya\estore\models\Product;

class EstoreController extends Controller
{
    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);
        
        return $this->render('index', [
            'provider' => $provider,
        ]);
    }
}
```

## ERD

Here you can see how the tables are connected with each other:

![ERD](https://cloud.githubusercontent.com/assets/3417221/26308614/3fdab2f2-3efa-11e7-904c-5965beda2f25.png)
