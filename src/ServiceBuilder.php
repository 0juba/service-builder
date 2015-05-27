<?php namespace ServiceBuilder;


require_once 'Core/Paths.php';


class ServiceBuilder
{

    private static $container = [];


    private static $instance = null;


    private function __construct()
    {

    }


    function __get($name)
    {
        if ( array_key_exists($name, static::$container) )
            return static::$container[$name];

        return null;
    }


    public static function load(array $services)
    {

        if (null === static::$instance) {
            static::$instance = new static;
        }

        foreach ( $services as $alias ) {
            $instance = getServiceInstance($alias);

            if ( $instance !== false )
                static::addService($alias,$instance);

        }

        return static::$instance;

    }


    private static function addService($alias,$service)
    {
        static::$container[$alias] = $service;
    }

}