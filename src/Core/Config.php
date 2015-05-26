<?php namespace ServiceBuilder\Core;


/**
 * Class Config
 * @package ServiceBuilder\Core
 */
class Config
{

    /** @var array  */
    protected $config = [];

    /**
     * @param $serviceName
     * @throws \Exception
     */
    function __construct($serviceName)
    {
        $fname = CONFIGS_DIR . '/' . strtolower( $serviceName . '.ini' );

        if ( !file_exists($fname) )
            throw new \Exception('Config for <'.$serviceName.'> not found!');

        $this->config = parse_ini_file ( $fname, true );

        if ( $this->config === false )
            throw new \Exception('Config for <'.$serviceName.'> has errors!');

        return true;
    }


    /**
     * @param $name
     * @param $value
     * @return bool
     */
    public function __set($name, $value)
    {
        if ( isset($this->config[$name]) ){
            $this->config[$name] = $value;
            return true;
        }

        return false;
    }


    /**
     * @param $name
     * @return null
     */
    function __get($name)
    {
        if ( isset ($this->config[$name]) )
            return $this->config[$name];

        return null;
    }

};