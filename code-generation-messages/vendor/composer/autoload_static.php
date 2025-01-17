<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite249306b8c7ac427060268586f916aff
{
    public static $files = array (
        'ce30818c35dfce0b74f3d34a4027ae2a' => __DIR__ . '/..' . '/http-interop/http-server-middleware/src/alias.php',
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '65fec9ebcfbb3cbb4fd0d519687aea01' => __DIR__ . '/..' . '/danielstjules/stringy/src/Create.php',
        'e050abfbc8f56b7048f9dd6785c2704d' => __DIR__ . '/../..' . '/src/Acme/OnlineShop/messages.php',
        'beae2941192c6ea988571aac70dbe0d4' => __DIR__ . '/../..' . '/src/Acme/OnlineShop/handlers.php',
        'fab84e1d0e5343ba2e54c79e364c03f2' => __DIR__ . '/../..' . '/src/Acme/Infra/EventSourcing/functions.php',
        '65e36eb9926234f31a0c62c39ff00e71' => __DIR__ . '/../..' . '/src/Acme/Infra/UI/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mindplay\\middleman\\' => 19,
        ),
        'Z' => 
        array (
            'Zend\\Diactoros\\' => 15,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Templating\\' => 29,
            'Stringy\\' => 8,
        ),
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
        ),
        'P' => 
        array (
            'Psr\\Http\\Server\\' => 16,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
        ),
        'M' => 
        array (
            'Money\\' => 6,
            'Middlewares\\Utils\\' => 18,
            'Middlewares\\' => 12,
        ),
        'I' => 
        array (
            'Interop\\Http\\Server\\' => 20,
            'Interop\\Http\\Factory\\' => 21,
        ),
        'F' => 
        array (
            'FastRoute\\' => 10,
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mindplay\\middleman\\' => 
        array (
            0 => __DIR__ . '/..' . '/mindplay/middleman/src',
        ),
        'Zend\\Diactoros\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-diactoros/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Templating\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/templating',
        ),
        'Stringy\\' => 
        array (
            0 => __DIR__ . '/..' . '/danielstjules/stringy/src',
        ),
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Psr\\Http\\Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-server-handler/src',
            1 => __DIR__ . '/..' . '/psr/http-server-middleware/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Money\\' => 
        array (
            0 => __DIR__ . '/..' . '/moneyphp/money/src',
        ),
        'Middlewares\\Utils\\' => 
        array (
            0 => __DIR__ . '/..' . '/middlewares/utils/src',
        ),
        'Middlewares\\' => 
        array (
            0 => __DIR__ . '/..' . '/middlewares/fast-route/src',
            1 => __DIR__ . '/..' . '/middlewares/request-handler/src',
        ),
        'Interop\\Http\\Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/http-interop/http-server-handler/src',
            1 => __DIR__ . '/..' . '/http-interop/http-server-middleware/src',
        ),
        'Interop\\Http\\Factory\\' => 
        array (
            0 => __DIR__ . '/..' . '/http-interop/http-factory/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $prefixesPsr0 = array (
        'A' => 
        array (
            'Acme\\' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static $classMap = array (
        'mindplay\\readable' => __DIR__ . '/..' . '/mindplay/readable/src/readable.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite249306b8c7ac427060268586f916aff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite249306b8c7ac427060268586f916aff::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite249306b8c7ac427060268586f916aff::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite249306b8c7ac427060268586f916aff::$classMap;

        }, null, ClassLoader::class);
    }
}
