<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2ca0b11f167fdee978f06a76734d4870
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LINE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2ca0b11f167fdee978f06a76734d4870::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2ca0b11f167fdee978f06a76734d4870::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
