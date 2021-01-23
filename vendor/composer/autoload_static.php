<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita8f3e1982492df90b732583d0479f4ab
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita8f3e1982492df90b732583d0479f4ab::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita8f3e1982492df90b732583d0479f4ab::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita8f3e1982492df90b732583d0479f4ab::$classMap;

        }, null, ClassLoader::class);
    }
}