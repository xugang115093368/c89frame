<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb374ede71f8b84e773f511792c7f4632
{
    public static $files = array (
        '145fa56471cf94fbb720ede7c1882047' => __DIR__ . '/../..' . '/system/helper.php',
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb374ede71f8b84e773f511792c7f4632::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb374ede71f8b84e773f511792c7f4632::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}