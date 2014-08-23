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

        public function indexAction()
        {
            $this->redirector->redirect('mainindex');
        }

        public function showAction($evaluate_id)
        {
            $ev                      = new \Application\Model\Evaluation();
            $data                    = $ev->get($evaluate_id);
            $class                   = (new \Application\Model\Classe)->all();
            
            $this->data->id          = $data['idEvaluation'];
            $this->data->titre       = $data['label'];
            $this->data->description = $data['description'];
            $this->data->class       = $class;

            $this->greut->render();
        }

        public function createAction()
        {
            echo '<pre>';
            print_r($_POST);
        }

        public function createActionAsync()
        {
            $this->createAction();
        }
    }
}
