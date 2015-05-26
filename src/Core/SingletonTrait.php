<?php namespace ServiceBuilder\Core;

trait SingletonTrait
{

    /**
     * @var null
     */
    protected static $instance = null;


    /**
     * @return null
     */
    public static function getInstance()
    {

        if (null === static::$instance) {
            static::$instance = new static;
        }

        return static::$instance;

    }


    /**
     *
     */
    protected function __construct()
    {

        $this->serviceName = strtolower (
            array_pop (
                explode ( '\\', get_called_class())
            ));

        $this->loadConfig();
        $this->applyConfig();

    }

}