<?php

namespace luya\estore\frontend\blockgroups;

use luya\cms\base\BlockGroup;
use luya\estore\frontend\Module;

/**
 * Estore Block Group.
 *
 * This group belongs to all new project based blocks by default.
 *
 * @author Bennet Klarhoelter <boehsermoe@me.com>
 */
class EStoreGroup extends BlockGroup
{
    public function identifier()
    {
        return 'estore-group';
    }
    
    public function label()
    {
        return Module::t('E-Store');
    }
    
    public function getPosition()
    {
        return 68;
    }
}
