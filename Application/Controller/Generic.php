<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Generic extends Kit
    {

        protected $connected = false;
        protected $loginId = null;
        protected $isAdmin = false;
        protected $isProfessor = false;
        protected $isModerator = false;
        protected $loginUser = '';
        protected $_acl = null;

        public function construct()
        {
            $session = new \Hoa\Session\Session('user', null, 5);
            if (isset($session['connect']) and $session['connect'] === true) {
                $this->connected                = true;
                $model                          = new \Application\Model\User();
                $model                          = $model->get($session['id']);
                $this->data->isConnect          = true;
                $this->loginUser                = $model['user'];
                $this->data->loginUser          = $this->loginUser;
                $this->isAdmin                  = ($model['isAdmin'] === '1') ? true : false;
                $this->isProfessor              = ($model['isProfessor'] === '1') ? true : false;
                $this->isModerator              = ($model['isModerator'] === '1') ? true : false;
                $this->data->loginIsModerator   = $this->isModerator;
                $this->data->loginIsProfessor   = $this->isProfessor;
                $this->data->loginIsAdmin       = $this->isAdmin;
                $this->loginId                  = $session['id'];
                $this->data->loginId            = $this->loginId;
                $group                          = array('student');
                $this->_acl                     = $this->framework->getAcl();

                if ($this->isAdmin === true) {
                    $group[] = 'admin';
                }
                if ($this->isProfessor === true) {
                    $group[] = 'professor';
                }
                if ($this->isModerator === true) {
                    $group[] = 'moderator';
                }

                $this->_acl->addUser($model['user'], $group);
            }

            $this->check();
        }

        public function isAvailable()
        {

            $rule   = $this->router->getTheRule();
            $call   = strtolower((isset($rule[4])) ? $rule[4] : '');
            $action = strtolower((isset($rule[5])) ? $rule[5] : '');

            $app = 'app.'.$call.'.'.$action;

            if ($this->connected === false) {
               $this->redirector->redirect('mainlogin');
            }

            if ($this->_acl->isAllow($this->loginUser, $app) === false) {
                $this->redirector->redirect('mainerror');
            }

        }

        public function only($gid)
        {
            return $this
                        ->_acl
                        ->getUser($this->loginUser)
                        ->groupExists($gid);
        }

        public function check()
        {
            $this->isAvailable();
        }

    }
}
