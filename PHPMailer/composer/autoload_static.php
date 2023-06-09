<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite7cde3c1419cc0c2d825803b85f4e055
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
            $loader->prefixLengthsPsr4 = ComposerStaticInite7cde3c1419cc0c2d825803b85f4e055::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite7cde3c1419cc0c2d825803b85f4e055::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite7cde3c1419cc0c2d825803b85f4e055::$classMap;

        }, null, ClassLoader::class);
    }
}
