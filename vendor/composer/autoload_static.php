<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7abf4d20bb7a19977d9816908974e30a
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SimplePay\\Vendor\\Stripe\\' => 24,
            'SimplePay\\Vendor\\' => 17,
            'SimplePay\\Core\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SimplePay\\Vendor\\Stripe\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Stripe/lib',
        ),
        'SimplePay\\Vendor\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'SimplePay\\Core\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7abf4d20bb7a19977d9816908974e30a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7abf4d20bb7a19977d9816908974e30a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7abf4d20bb7a19977d9816908974e30a::$classMap;

        }, null, ClassLoader::class);
    }
}
