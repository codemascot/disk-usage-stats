<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit92a34376ae75c792d0dbf25d20ce03b3
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TheDramatist\\DiskUsageStats\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TheDramatist\\DiskUsageStats\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit92a34376ae75c792d0dbf25d20ce03b3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit92a34376ae75c792d0dbf25d20ce03b3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
