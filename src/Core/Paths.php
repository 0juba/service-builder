<?php

/**
 * Library dir
 */
define ( 'LIB_DIR',     __DIR__ . '/../'      );

/**
 * Config dir
 */
define ( 'CONFIGS_DIR',  LIB_DIR . 'Configs'   );


/**
 * Services dir
 */
define ( 'SERVICES_DIR', LIB_DIR . 'Services' );


function getServiceInstance($alias)
{

    $fname = SERVICES_DIR . '/' . ucfirst($alias) . '.php';
    $class = 'ServiceBuilder\Services\\' . ucfirst($alias);

    if ( file_exists($fname) and class_exists($class) ) {
        return call_user_func_array([$class,'getInstance'],[]);
    }

    return false;

}


