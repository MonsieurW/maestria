<?php
namespace Application\Maestria;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\GelfHandler;
use Monolog\Formatter\LineFormatter;
use Gelf\MessagePublisher; 
    
class Log
{
    
    protected static $_instance = null;
    protected static $_logFile  = 'hoa://Application/Log/app.log';

    protected static function init()
    {
        if(static::$_instance === null) {
            static::$_logFile = resolve(static::$_logFile, false);
            
            if(file_exists(static::$_logFile) === false){
                touch(static::$_logFile);
            }

            $dateFormat     = "Y-m-d H:i:s";
            $output         = "[%datetime%] [%channel%] [%level_name%] %message% %context%\n";
            $formatter      = new LineFormatter($output, $dateFormat);
            $streamHandler  = new StreamHandler(static::$_logFile, Logger::INFO);
            $log            = new Logger('maestria');

            $streamHandler->setFormatter($formatter);
            $log->pushHandler($streamHandler);
            $log->pushHandler(new GelfHandler(new MessagePublisher('log.ark.im')));


            static::$_instance = $log;
        }
    }

    public static function debug($msg, $data = array())
    {
        static::init();
        static::$_instance->addDebug($msg, $data);
    }


    public static function info($msg, $data = array())
    {
        static::init();
        static::$_instance->addInfo($msg, $data);
    }

    public static function error($msg, $data = array())
    {
        static::init();
        static::$_instance->addError($msg, $data);   
    }
}
