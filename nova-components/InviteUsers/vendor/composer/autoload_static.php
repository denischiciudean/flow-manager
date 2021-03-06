<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit62494fa3b8a8e57d463e46a0578b27e7
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tools\\InviteUsers\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tools\\InviteUsers\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit62494fa3b8a8e57d463e46a0578b27e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit62494fa3b8a8e57d463e46a0578b27e7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit62494fa3b8a8e57d463e46a0578b27e7::$classMap;

        }, null, ClassLoader::class);
    }
}
