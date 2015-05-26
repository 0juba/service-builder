<?php namespace ServiceBuilder\Services;


use ServiceBuilder\Core\ServiceWrapper;
use \Doctrine\DBAL\Configuration as DoctrineConfiguration;
use \Doctrine\DBAL\DriverManager as DoctrineDriverManager;
use ServiceBuilder\Core\SingletonTrait;
use Twig_Environment;
use Twig_Loader_Filesystem;


/**
 * Class Doctrine
 * @package ServiceBuilder\Services
 */
class Twig extends ServiceWrapper
{

    use SingletonTrait;

    protected $loader;

    /**
     * @return mixed
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * @param mixed $loader
     */
    private function setLoader($loader)
    {
        $this->loader = $loader;
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    public function applyConfig()
    {

            $loader = new Twig_Loader_Filesystem(array_map(function($item){
                return LIB_DIR . $item;
            },$this->config->dirs));

            $this->setLoader($loader);

            $required = ['debug','charset','base_template_class','cache','auto_reload','strict_variables'];

            foreach ( $required as $param ) {
                if (!array_key_exists($param, $this->config->twig))
                    throw new \Exception('Miss required options in the config: ' . $this->serviceName . ', ' . $param . '!');
            }

            $this->service = new Twig_Environment($loader,$this->config->twig);

    }

}