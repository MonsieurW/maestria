<?php

/**
 * Se mettre d'accord sur la doc
 */
namespace Application\Maestria;

class Router extends \Sohoa\Framework\Router
{
    protected static $_everLoad = false;

    public function construct()
    {
        if(static::$_everLoad === false)
        {
            echo 'Load';
            parent::construct();
            static::$_everLoad = true;
        }
    }   
}