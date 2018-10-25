<?php

namespace luya\estore\frontend;

/**
 * Estore Admin Module.
 *
 * File has been created with `module/create` command on LUYA version 1.0.0-dev.
 */
class Module extends \luya\base\Module
{
    /**
     * @inheritdoc
     */
    public static function onLoad()
    {
        self::registerTranslation('estoreadmin*', static::staticBasePath() . '/messages', [
            'estoreadmin' => 'estoreadmin.php',
        ]);
    }

    /**
     * Translations for CMS admin Module.
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('estoreadmin', $message, $params);
    }
}
