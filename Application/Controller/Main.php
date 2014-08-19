<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Main extends Kit
    {

    	protected $connected = false;
    	public function construct()
    	{
    		$session = new \Hoa\Session\Session('user');
			if(isset($session['connect']) or $session['connect'] === false ){

        		$this->connected 		 = true;
                $this->data->isAdmin     = true;
                $this->data->isModerator = true;
                $this->data->isProfessor = true;
        		$this->data->isConnect 	 = true;
                $this->data->user        = 'Gordon Freeman x';
                $this->data->idProfil    = 5;
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

        	if($user === '' or $password === ''){ // TODO : 
        		$this->data->hasError = true;
        		return $this->greut->render(array('Main' , 'connect'));
        	}

        	$session['connect'] = true;

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

            $this->data->login       = 'foo';
            $this->data->idProfil    = 5;   
            $this->data->class       = array(
                array('id' => 1 , 'name' => '2°K'),
                array('id' => 2 , 'name' => '2°L'),
                array('id' => 3 , 'name' => 'T°L'),
            );
            $this->data->domain     = array('Physique' , 'Chimie');
            $this->greut->render();
        }
    }
}
