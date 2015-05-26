<?php namespace ServiceBuilder\Core;


/**
 * Class ServiceWrapper
 * @package ServiceBuilder\Core
 */
abstract class ServiceWrapper implements IServiceInterface
{

    /** @var  Config */
    protected $config;

    /** @var Mixed */
    protected $service = null;

    /** @var string  */
    protected $serviceName = '';


    /**
     * @return Mixed
     */
    function getService()
    {
        return $this->service;
    }


    /**
     *
     */
    function  loadConfig()
    {
        $this->config = new Config($this->serviceName);
    }


    /**
     * @param $name
     * @param $arguments
     * @throws \Exception
     */
    function __call($name, $arguments)
    {

        if ( is_callable([$this->getService(),$name]) or method_exists($this->getService(),$name) )
            return call_user_func_array([$this->getService(),$name],$arguments);

        throw new \Exception('Method '.$name.' does not exists!');

    }


    abstract public function applyConfig();


}