<?php namespace ServiceBuilder\Services;


use ServiceBuilder\Core\ServiceWrapper;
use ServiceBuilder\Core\SingletonTrait;


class Redis extends ServiceWrapper
{

    use SingletonTrait;

    public function applyConfig()
    {

        $required = ['host','port','pass'];
        $config   = $this->config;

        foreach ( $required as $param )
            if ( $config->{$param} !== null )
                $connectionParams[$param] = $config->{$param};
            else
                throw new \Exception('Miss required options in the config: '. $this->serviceName .', '.$param.'!');

        $dsn = sprintf('redis://:%s@%s:%s',$config->pass,$config->host,$config->port);

        $this->service = new \redisent\Redis($dsn);

    }

}