<?php
namespace Application\Maestria {

    class Loader
    {
        private static $_resource = array();

        public static function load(\Sohoa\Framework\Framework $framework)
        {
            $acl    = \Hoa\Acl\Acl::getInstance();
            $router = $framework->getRouter();

            $router->construct();

            $rules = $router->getRules();

            foreach ($rules as $rule) {
                $call = null;
                $action = null;

                if (isset($rule[4])) {
                    $call = $rule[4];
                }

                if (isset($rule[5])) {
                    $action = $rule[5];
                }

                if ($call !== null and $action !== null) {
                    $app = 'app.'.strtolower($call).'.'.strtolower($action);

                    if (!in_array($app, self::$_resource)) {
                        self::$_resource[] = $app;

                    }
                }
            }
        }

        public static function allow($string, $gid)
        {
            $acl = \Hoa\Acl\Acl::getInstance();
            foreach (self::$_resource as $ressource) {

                if (preg_match('#^'.$string.'$#', $ressource) !== 0) {
                    echo $ressource.'<br />';
                    $acl->allow($gid, new \Hoa\Acl\Permission($ressource));
                }
            }

        }

        public static function deny($string, $gid)
        {
            $acl = \Hoa\Acl\Acl::getInstance();
            foreach (self::$_resource as $ressource) {

                if (preg_match('#^'.$string.'$#', $ressource) !== 0) {
                    $acl->deny($gid, new \Hoa\Acl\Permission($ressource));
                }
            }

        }

        public static function isAllow($uid, $resource)
        {
            $acl = \Hoa\Acl\Acl::getInstance();

            return $acl->isAllowed($uid, $resource, 'f');

        }

    }
}
