<?php

namespace luya\estore\tests;

use luya\testsuite\cases\WebApplicationTestCase;

class EstoreTestCase extends WebApplicationTestCase
{
    public function getConfigArray()
    {
        return [
            'id' => 'estoreapp',
            'basePath' => dirname(__DIR__),
            'modules' => [
                'estore' => [
                    'class' => 'luya\estore\frontend\Module',
                ],
                'estoreadmin' => [
                    'class' => 'luya\estore\admin\Module',
                ]
            ],
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost',
                ],
            ]
        ];
    }
}
