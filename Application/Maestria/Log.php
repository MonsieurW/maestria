<?php
namespace Application\Maestria {

    class Log
    {
        private static $_log = 'hoa://Application/Log/app.log';
        private static $_instance = null;

        protected static function _msg($lvl, $message)
        {
            file_put_contents(static::$_log, implode("\t", ['['.date('d-m-Y H:i:s').']', $lvl, $message])."\n", FILE_APPEND);
        }

        public static function info($msg)
        {
            static::_msg('info', $msg);
        }
    }
}
