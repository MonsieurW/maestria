<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Professor extends Generic
    {
        public function check()
        {
            if($this->connected === false){
                $this->redirector->redirect('mainlogin');
            }

        }

        public function indexAction()
        {
            $this->redirector->redirect('profilall');
        }

        public function showAction($professor_id)
        {
            $this->redirector->redirect('profiluser', array('id' => $professor_id));
        }
        
    }
}
