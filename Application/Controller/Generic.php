<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Generic extends Kit
    {

        protected $connected = false;
        protected $loginId = null;
        protected $isAdmin = false;
        protected $isProfessor = false;

        public function construct()
        {
            $session = new \Hoa\Session\Session('user');
            if (isset($session['connect']) and $session['connect'] === true) {
                $this->connected                = true;
                $model                          = new \Application\Model\User();
                $model                          = $model->get($session['id']);
                $this->data->isConnect          = true;
                $this->data->loginUser          = $model['user'];
                $this->isAdmin                  = ($model['isAdmin'] === '1') ? true : false; // TODO : Make it global !
                $this->isProfessor              = ($model['isProfessor'] === '1') ? true : false; // TODO : Make it global !
                $this->data->loginIsModerator   = ($model['isModerator'] === '1') ? true : false;
                $this->data->loginIsProfessor   = ($model['isProfessor'] === '1') ? true : false;
                $this->data->loginIsAdmin       = $this->isAdmin;
                $this->loginId                  = $session['id'];
                $this->data->loginId            = $this->loginId;
            }

            $this->check();
        }

        public function check()
        {

        }
    }
}
