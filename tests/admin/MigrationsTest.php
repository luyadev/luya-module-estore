<?php

namespace luya\estore\tests\admin;

use luya\estore\tests\EstoreTestCase;
use luya\testsuite\traits\MigrationFileCheckTrait;

class MigrationsTest extends EstoreTestCase
{
    use MigrationFileCheckTrait;
    
    public function testMigrationFiles()
    {
        $this->checkMigrationFolder('@estoreadmin/migrations');
    }
}