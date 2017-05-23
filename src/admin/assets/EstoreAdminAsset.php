<?php

namespace luya\estore\admin\assets;

use luya\web\Asset;

class EstoreAdminAsset extends Asset
{
    public $sourcePath = '@estoreadmin/resources';
    
    public $js = [
        'estoreAttributes.js',
    ];
    
    public $depends = [
        'luya\admin\assets\Main',
    ];
}