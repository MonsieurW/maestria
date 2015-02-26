<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Student extends Generic
    {
        public function indexAction()
        {
            if($this->_allIsGood === false)
                return;
            
            return $this->redirector->redirect('profilall');
        }

        public function showAction($student_id)
        {
            if($this->_allIsGood === false)
                return;
            
            return $this->redirector->redirect('profiluser', array('id' => $student_id));
        }

    }
}
