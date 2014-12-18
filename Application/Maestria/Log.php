<?php
namespace Application\Maestria;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
    
class Log
{
    
    protected static $_instance = null;
    protected static $_logFile  = 'hoa://Application/Log/app.log';

    public static function info($msg)
    {

        if(static::$_instance === null) {
            $dateFormat     = "Y-m-d H:i:s";
            $output         = "[%datetime%] [%channel%] [%level_name%] %message%\n";
            $formatter      = new LineFormatter($output, $dateFormat);
            $streamHandler  = new StreamHandler(static::$_logFile, Logger::DEBUG);
            $log            = new Logger('maestria');

            $streamHandler->setFormatter($formatter);
            $log->pushHandler($streamHandler);

            static::$_instance = $log;
        }
        static::$_instance->addDebug($msg);
    }

}
