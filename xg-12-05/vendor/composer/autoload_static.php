<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit587e5678816bc2e93402d0fa2876cb95
{
    public static $files = array (
        '2e628889194b094a97df95f7ce8102d3' => __DIR__ . '/../..' . '/system/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'h' => 
        array (
            'houdunwang\\' => 11,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'houdunwang\\' => 
        array (
            0 => __DIR__ . '/../..' . '/houdunwang',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit587e5678816bc2e93402d0fa2876cb95::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit587e5678816bc2e93402d0fa2876cb95::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}