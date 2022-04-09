<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd6632fc1aaa4cf71ea13967b4372ae4e
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitd6632fc1aaa4cf71ea13967b4372ae4e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd6632fc1aaa4cf71ea13967b4372ae4e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        \Composer\Autoload\ComposerStaticInitd6632fc1aaa4cf71ea13967b4372ae4e::getInitializer($loader)();

        $loader->register(true);

        return $loader;
    }
}
