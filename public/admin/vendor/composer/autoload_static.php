<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita0ae1cc7acde3791c242a5519d1433c0
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInita0ae1cc7acde3791c242a5519d1433c0::$classMap;

        }, null, ClassLoader::class);
    }
}
