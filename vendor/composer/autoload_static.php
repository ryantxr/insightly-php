<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc0909912f9efa2bc551a4dc6cc60922a
{
    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Ryantxr\\Insightly' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitc0909912f9efa2bc551a4dc6cc60922a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}