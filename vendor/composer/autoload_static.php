<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8fbc8465a862336fc16a36d689ea2ca3
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit8fbc8465a862336fc16a36d689ea2ca3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8fbc8465a862336fc16a36d689ea2ca3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8fbc8465a862336fc16a36d689ea2ca3::$classMap;

        }, null, ClassLoader::class);
    }
}