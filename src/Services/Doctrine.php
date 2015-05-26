<?php namespace ServiceBuilder\Services;


use ServiceBuilder\Core\ServiceWrapper;
use \Doctrine\DBAL\Configuration as DoctrineConfiguration;
use \Doctrine\DBAL\DriverManager as DoctrineDriverManager;
use ServiceBuilder\Core\SingletonTrait;


/**
 * Class Doctrine
 * @package ServiceBuilder\Services
 */
class Doctrine extends ServiceWrapper
{

    use SingletonTrait;

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public function applyConfig()
    {

        $DBALConfig = new DoctrineConfiguration();

        $config     = $this->config;

        $required   = ['dbname','user','password','host','driver','port','charset'];

        $connectionParams = [];

        foreach ( $required as $param )
            if ( $config->{$param} !== null )
                $connectionParams[$param] = $config->{$param};
            else
                throw new \Exception('Miss required options in the config: '. $this->serviceName .', '.$param.'!');

        $this->service = DoctrineDriverManager::getConnection($connectionParams, $DBALConfig);

    }

}