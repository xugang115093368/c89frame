<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0968da1ee97d56af83283884887b82af
{
    public static $files = array (
        'ec392715e97d938df5bc60cde5a984c2' => __DIR__ . '/../..' . '/system/helper.php',
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit0968da1ee97d56af83283884887b82af::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0968da1ee97d56af83283884887b82af::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
