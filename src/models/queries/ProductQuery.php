<?php

namespace luya\estore\models\queries;

use luya\admin\ngrest\base\NgRestActiveQuery;
use luya\estore\models\Group;

class ProductQuery extends NgRestActiveQuery
{
    public function actives()
    {
        return $this->andWhere(['enabled' => 1]);
    }

    public function category($categoryId)
    {
        return $this->joinWith('groups')->andWhere([Group::tableName() . '.id' => $categoryId]);
    }
}