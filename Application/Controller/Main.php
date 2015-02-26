<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Generic
    {
        public function check()
        {
            // TODO : Use token for auth the connection and the user !
            // TODO : Verif csrf
            // TODO : Oublie de mot de passe & mail divers
        }

        public function indexAction()
        {
            if($this->_allIsGood === false)
                return;
            
            if ($this->connected === false) {
               return $this->redirector->redirect('mainlogin');
            }

            $evaluation             = new \Application\Model\Evaluation();
            $evaluation             = $evaluation->all();
            // TODO : Make pages
            $this->data->evaluation = $evaluation;

            return $this->greut->render();
        }

        public function connectAction()
        {
            if($this->_allIsGood === false)
                return;
            
            if ($this->connected === true) {
               return $this->redirector->redirect('mainindex');
            }

            $this->data->referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';

            return $this->greut->render();
        }

        public function loginAction()
        {
            $user        = isset($_POST['user']) ? $_POST['user'] : '';
            $password    = isset($_POST['password']) ? $_POST['password'] : '';
            $session     = new \Hoa\Session\Session('user');
            $model       = new \Application\Model\User();
            $redirect    = isset($_POST['referer']) ? $_POST['referer'] : null;

            if ($user === '' or $password === '') {
                $this->data->hasError = true;

                return $this->greut->render(array('Main' , 'connect'));
            }

            if ($model->check($user, $password) === false) {
                $this->data->hasError = true;

                return $this->greut->render(array('Main' , 'connect'));
            }
            $model              = $model->getByUser($user);
            $session['connect'] = true;
            $session['id']      = $model['idProfil'];
            $hoa                = $_SESSION['__Hoa__']['user'][0];

            echo 'TEST';
            \Application\Maestria\Log::debug('Connect : '.$user);
            \Application\Maestria\Log::debug('Cache Expire : '.session_cache_expire());
            \Application\Maestria\Log::debug('Start : '.$hoa['started']->format('d-m-Y H:i:s'));
            \Application\Maestria\Log::debug('Lifetime : '.$hoa['lifetime']->format('d-m-Y H:i:s'));

            if ($redirect === null) {
               return $this->redirector->redirect('mainindex');
            } else {
               return $this->redirector->url($redirect);
            }

        }

        public function logoutAction()
        {
            $session            = new \Hoa\Session\Session('user');
            $session['connect'] = false;
            $session['id']      = null;

            \Hoa\Session\Session::destroy();
            \Application\Maestria\Log::debug('Logout');
            return $this->redirector->redirect('mainindex');
        }

        public function registerAction()
        {
            if ($this->connected === true) {
                return $this->greut->render();
            }

            return $this->redirector->redirect('mainlogin');
        }

        public function profilAction($id)
        {
            if($this->_allIsGood === false)
                return;
            
            if ($this->connected === false) {

                return $this->redirector->redirect('mainlogin');
            }
            if($this->readUserInformation($id) === true)

                return $this->greut->render();
            else
                return $this->greut->render(array('Main' , 'NotFound'));

        }

        public function profilallAction()
        {
            if($this->_allIsGood === false)
                return;
            
            $query       = $this->router->getQuery();
            $page        = isset($query['page']) ? $query['page'] : 1;
            $nbPost      = 20;
            $first_entry = ($page - 1) * $nbPost;

            $model                   = new \Application\Model\User();
            $this->data->all         = $model->getAllWithPage($first_entry, $nbPost);
            $this->data->pageCurrent = $page;
            $this->data->pageTotal   = ceil($model->count() / $nbPost);

            $this->greut->render();
        }

        public function createAction()
        {
            if($this->_allIsGood === false)
                return;
            
            $p = function ($id) {
                if(array_key_exists($id, $_POST))

                    return $_POST[$id];

                return null;
            };

            if ($this->connected === false) {

                return $this->redirector->redirect('mainlogin');
            }

            $login      = $p('login');
            $user       = $p('name');
            $password   = $p('passwd');
            $model      = new \Application\Model\User();

            $model->add($login, $password, $user);
            return $this->redirector->redirect('profilall');
        }

        public function errorAction()
        {
            if($this->_allIsGood === false)
                return;
            
            $this->greut->render();
        }

        public function profileditAction($id)
        {
            if($this->_allIsGood === false)
                return;
            
            if ($this->connected === false) {

                return $this->redirector->redirect('mainlogin');
            }

            if ($this->isAdmin === true or $id === $this->loginId) {

                $model                      = new \Application\Model\User();
                $model                      = $model->get($id);

                if ($model === false) {
                    return $this->greut->render('hoa://Application/View/Main/NotFound.tpl.php');
                }

                $this->data->idProfil       = $model['idProfil'];
                $this->data->login          = $model['login'];
                $this->data->user           = $model['user'];
                $this->data->class          = $model['class'];
                $this->data->domain         = $model['domain'];
                $this->data->isAdmin        = ($model['isAdmin'] === '1') ? true : false;
                $this->data->isModerator    = ($model['isModerator'] === '1') ? true : false;
                $this->data->isProfessor    = ($model['isProfessor'] === '1') ? true : false;

                return $this->greut->render();
            }

            return $this->redirector->redirect('mainindex');
        }

        public function profilupdateAction($id)
        {
            if($this->_allIsGood === false)
                return;
            
            $p = function ($id) {
                if(array_key_exists($id, $_POST))

                    return $_POST[$id];

                return null;
            };

            $c = function ($id) {
                if(array_key_exists($id, $_POST) and $_POST[$id] === 'on')

                    return '1';

                return '0';
            };

            if ($this->isAdmin === true or $id === $this->loginId) { // TODO : Only mod,prof,admin

                $model          = new \Application\Model\User();
                $uc             = new \Application\Model\UserClass();
                $ud             = new \Application\Model\UserDomain();
                $login          = $p('login');
                $user           = $p('name');
                $password       = $p('passwd');
                $opassword      = $p('oldpasswd');
                $class          = $p('classroom');
                $domain         = $p('domain');
                $isAdmin        = $c('isAdmin');
                $isModerator    = $c('isModerator');
                $isProfessor    = $c('isProfessor');

                // UPDATE Password

                if ($opassword !== '' && $model->checkWithId($id, $opassword) === true) {
                    $model->updatePassword($id, $password);
                }

                if ($domain !== null) {
                    $domain = explode(',', $domain);
                }

                if ($class !== null) {
                    $class = explode(',', $class);
                }

                $model->update($id, 'login', $login);
                $model->update($id, 'user', $user);
                $model->update($id, 'isAdmin', $isAdmin);
                $model->update($id, 'isModerator', $isModerator);
                $model->update($id, 'isProfessor', $isProfessor);

                $uc->sync($id, $class);
                $ud->sync($id, $domain);

                return $this->redirector->redirect('profiluser', array('id' => $id));
            }

            return $this->redirector->redirect('mainindex');
        }

        protected function readUserInformation($id)
        {
            if($this->_allIsGood === false)
                return;
            
            $model = new \Application\Model\User();

            if ($model->exists($id) === true ) {
                $model                      = $model->get($id);
                $this->data->idProfil       = $model['idProfil'];
                $this->data->login          = $model['login'];
                $this->data->isAdmin        = ($model['isAdmin'] === '1') ? true : false;
                $this->data->isModerator    = ($model['isModerator'] === '1') ? true : false;
                $this->data->isProfessor    = ($model['isProfessor'] === '1') ? true : false;
                $this->data->user           = $model['user'];
                $this->data->class          = $model['class'];
                $this->data->domain         = $model['domain'];

                return true;
            }

            return false;
        }
    }
}
