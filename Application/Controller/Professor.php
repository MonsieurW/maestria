<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Professor extends Generic
    {
        public function indexAction()
        {
            if($this->_allIsGood === false)
                return;
            
            return $this->redirector->redirect('profilall');
        }

        public function showAction($professor_id)
        {
            if($this->_allIsGood === false)
                return;
            
            return $this->redirector->redirect('profiluser', array('id' => $professor_id));
        }

    }
}
