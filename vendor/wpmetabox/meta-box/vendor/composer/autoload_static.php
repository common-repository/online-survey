<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit329d4811fa4ff7cde413f13119b67912
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MetaBox\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MetaBox\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit329d4811fa4ff7cde413f13119b67912::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit329d4811fa4ff7cde413f13119b67912::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit329d4811fa4ff7cde413f13119b67912::$classMap;

        }, null, ClassLoader::class);
    }
}