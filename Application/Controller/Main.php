<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Generic
    {
        public function indexAction()
        {

        	if($this->connected === true){

                if($this->isProfessor === true)
                  $this->redirector->redirect('showEvaluation', array('professor_id' => $this->loginId));
                else
        		  $this->redirector->redirect('showStudent', array('student_id' => $this->loginId));
        	}

        	$this->redirector->redirect('mainlogin');
        }

        public function connectAction()
        {
        	return $this->greut->render();	
        }

        public function loginAction()
        {
        	$user 		= isset($_POST['user']) ? $_POST['user'] : '';
        	$password 	= isset($_POST['password']) ? $_POST['password'] : '';
			$session 	= new \Hoa\Session\Session('user');
            $model      = new \Application\Model\User();

        	if($user === '' or $password === '')
            { 
        		$this->data->hasError = true;
        		return $this->greut->render(array('Main' , 'connect'));
        	}

            if($model->check($user, $password) === false)
            {
                $this->data->hasError = true;
                return $this->greut->render(array('Main' , 'connect'));   
            }
            $model              = $model->getByUser($user);
        	$session['connect'] = true;
            $session['id']      = $model['idProfil'];

        	$this->redirector->redirect('mainindex');	
        }

        public function logoutAction()
        {
        	$session 			= new \Hoa\Session\Session('user');
        	$session['connect'] = false;
            $session['id']      = null;

        	\Hoa\Session\Session::destroy();

        	$this->redirector->redirect('mainindex');	
        }

        public function registerAction()
        {
            if($this->connected === true){

                return $this->greut->render();  
            }

            $this->redirector->redirect('mainlogin');
        }

        public function profilAction($id)
        {
            if($this->connected === false){

                $this->redirector->redirect('mainlogin');
            }
            if($this->readUserInformation($id) === true)
                return $this->greut->render();
            else
                return $this->greut->render(array('Main' , 'NotFound'));

            
        }

        public function profilallAction()
        {
            $model              = new \Application\Model\User();
            $model              = $model->all();
            $this->data->all    = $model;

            $this->greut->render();
        }

        public function createAction()
        {
            $p = function ($id) {
                if(array_key_exists($id, $_POST))
                    return $_POST[$id];

                return null;
            };

              if($this->connected === false){

                $this->redirector->redirect('mainlogin');
            }


            $login      = $p('login');
            $user       = $p('name');
            $password   = $p('passwd');
            $model      = new \Application\Model\User();

            $model->add($login, $password, $user);
            $this->redirector->redirect('profilall');
        }

        public function profileditAction($id)
        {
              if($this->connected === false){

                $this->redirector->redirect('mainlogin');
            }


            if($this->isAdmin === true or $id === $this->loginId ) {
            
                $model                      = new \Application\Model\User();
                $model                      = $model->get($id); // TODO : Check if profil exist or notfound
                
                if($model === false)
                {
                    return $this->greut->render('hoa://Application/View/Main/NotFound.tpl.php'); // Check
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
            
            $this->redirector->redirect('mainindex');
        }

        public function profilupdateAction($id)
        {
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

            if($this->isAdmin === true or $id === $this->loginId ) { // TODO : Only mod,prof,admin

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

                if($opassword !== '' && $model->checkWithId($id, $opassword) === true)
                {
                    $model->updatePassword($id, $password);
                    echo 'UPDATE password';
                }


                if($domain !== null)
                    $domain = explode(',', $domain);

                if($class !== null)
                    $class = explode(',', $class);

                $model->update($id, 'login', $login);
                $model->update($id, 'user', $user);
                $model->update($id, 'isAdmin', $isAdmin);
                $model->update($id, 'isModerator', $isModerator);
                $model->update($id, 'isProfessor', $isProfessor);

                $uc->sync($id, $class);
                $ud->sync($id, $domain);

                $this->redirector->redirect('profiluser', array('id' => $id));
            }
            
            $this->redirector->redirect('mainindex');
        }

        protected function readUserInformation($id) 
        {
            $model = new \Application\Model\User();

            if($model->exists($id) === true ) {
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
