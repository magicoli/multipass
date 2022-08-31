<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfe6292387e56d846764579a2c23c0495
{
    public static $files = array (
        '23e92b0e70bc71ebe8e5a382f1a5652a' => __DIR__ . '/..' . '/meta-box/meta-box/meta-box.php',
        '8771acd7754cd5526bb29fae66e89026' => __DIR__ . '/..' . '/meta-box/meta-box-columns/meta-box-columns.php',
        '3d8ae901d95bb0104a1c51414a8c5d1d' => __DIR__ . '/..' . '/meta-box/meta-box-conditional-logic/meta-box-conditional-logic.php',
        '4f0709d7d5ca45c2d93532f309176335' => __DIR__ . '/..' . '/meta-box/meta-box-group/meta-box-group.php',
        '1688fd0706033116c32103002045d66b' => __DIR__ . '/..' . '/meta-box/meta-box-include-exclude/meta-box-include-exclude.php',
        '1d84e39720398ae69aabb7481a1095fb' => __DIR__ . '/..' . '/meta-box/meta-box-show-hide/meta-box-show-hide.php',
        '77ea69ad6ea6c44c88696aa6d206c4e9' => __DIR__ . '/..' . '/meta-box/mb-admin-columns/mb-admin-columns.php',
        'dea16cc47f4d4e803c3d58d1238c32a7' => __DIR__ . '/..' . '/meta-box/mb-settings-page/mb-settings-page.php',
        'ad795f737f50665a589664d97d9ec553' => __DIR__ . '/..' . '/meta-box/meta-box-tabs/meta-box-tabs.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpImap\\' => 8,
        ),
        'C' => 
        array (
            'Currency\\Util\\' => 14,
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpImap\\' => 
        array (
            0 => __DIR__ . '/..' . '/php-imap/php-imap/src/PhpImap',
        ),
        'Currency\\Util\\' => 
        array (
            0 => __DIR__ . '/..' . '/terdia/currency-util/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'WP_Async_Request' => __DIR__ . '/..' . '/deliciousbrains/wp-background-processing/classes/wp-async-request.php',
        'WP_Background_Process' => __DIR__ . '/..' . '/deliciousbrains/wp-background-processing/classes/wp-background-process.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfe6292387e56d846764579a2c23c0495::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfe6292387e56d846764579a2c23c0495::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfe6292387e56d846764579a2c23c0495::$classMap;

        }, null, ClassLoader::class);
    }
}
