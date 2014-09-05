<?php
namespace Application\Maestria {
    class Acl
    {
        protected $_acl = null;
        protected $_framework = null;
        protected $_resource = array();

        public function __construct(\Sohoa\Framework\Framework $framework)
        {
            $this->_acl          = \Hoa\Acl\Acl::getInstance();
            $this->_framework    = $framework;

            $admin        = new \Hoa\Acl\Group('admin');
            $professor    = new \Hoa\Acl\Group('professor');
            $student      = new \Hoa\Acl\Group('student');
            $resource     = new \Hoa\Acl\Resource('foo');

            $this->_acl->addGroup($admin);
            $this->_acl->addGroup($professor);
            $this->_acl->addGroup($student);
            $this->_acl->addResource($resource);

            $this->load();

        }

        protected function load()
        {
            $router = $this->_framework->getRouter();
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

                    if (!in_array($app, $this->_resource)) {
                        $this->_resource[] = $app;

                    }
                }
            }
        }

        public function allow($string, $gid)
        {
            foreach ($this->_resource as $ressource) {

                if (preg_match('#^'.$string.'$#', $ressource) !== 0) {
                    echo $ressource.'<br />';
                    $this->_acl->allow($gid, new \Hoa\Acl\Permission($ressource));
                }
            }

            return $this;

        }

        public function isAllow($uid, $resource)
        {
            return $this->_acl->isAllowed($uid, $resource, 'foo');
        }

        public function getAcl()
        {
        	return $this->_acl;
        }

        public function addUser($label, $group)
        {
            $user = new \Hoa\Acl\User($label);
            $user->addGroup($group);

            $this->_acl->addUser($user);

            return $this;
        }
    }
}
