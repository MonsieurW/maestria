<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Evaluate extends Generic
    {
    	public function check()
        {
            if($this->connected === false){
                $this->redirector->redirect('mainlogin');
            }

        }

        public function showAction($evaluate_id)
        {
            var_dump($evaluate_id);
        }
    }
}
