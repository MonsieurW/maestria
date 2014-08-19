<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Kit
    {

    	protected $connected = false;
    	public function construct()
    	{
    		$session = new \Hoa\Session\Session('user');
			if(isset($session['connect']) and $session['connect'] === true)
            {
        		$this->connected 		        = true;
                $model                          = new \Application\Model\User();
                $model                          = $model->get($session['id']);
                $this->data->isConnect          = true;
                $this->data->loginUser          = $model['user'];
                $this->data->loginIsAdmin       = ($model['isAdmin'] === '1') ? true : false;
                $this->data->loginIsModerator   = ($model['isModerator'] === '1') ? true : false;
                $this->data->loginId            = $session['id'];
        	}
        	
    	}

        public function indexAction()
        {

        	if($this->connected === true){

        		return $this->greut->render();	
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

        	$session['connect'] = true;
            $session['id']      = 1;

        	$this->redirector->redirect('mainindex');	
        }

        public function logoutAction()
        {
        	$session 			= new \Hoa\Session\Session('user');
        	$session['connect'] = false;

        	\Hoa\Session\Session::destroy();

        	$this->redirector->redirect('mainindex');	
        }

        public function registerAction()
        {
        	$this->greut->render();
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
