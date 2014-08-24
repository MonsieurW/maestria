<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Student extends Generic
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

        public function showAction($student_id)
        {
            $this->redirector->redirect('profiluser', array('id' => $student_id));
        }
        
    }
}
