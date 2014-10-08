<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Evaluate extends Generic
    {
        public function indexAction()
        {
            $this->redirector->redirect('mainindex');
        }

        public function showAction($evaluate_id)
        {
            $ev                      = new \Application\Model\Evaluation();
            $data                    = $ev->get($evaluate_id);
            $class                   = (new \Application\Model\Classe())->all();

            if (empty($data)) {
                return $this->greut->render('hoa://Application/View/Main/NotFound.tpl.php');
            }

            $this->data->id          = $data['idEvaluation'];
            $this->data->titre       = $data['label'];
            $this->data->description = $data['description'];
            $this->data->class       = $class;

            $this->greut->render();
        }

        public function createAction()
        {
            $idEvaluation = null;
            $questions    = array();
            $response     = array();
            $answer       = new \Application\Model\Answer();
            $user         = (isset($_POST['user'])) ? $_POST['user'] : '0';

            if ($this->connected === false) {
                $response = array(
                    'status' => 500,
                    'message' => 'Need to login'
                );

                echo json_encode($response);
                exit;
            }

            foreach ($_POST as $key => $value) {
                if ($key === 'evaluation') {
                    $idEvaluation = $value;
                } elseif ($key === 'user') {

                } else {
                    preg_match('#^u(.*)q(.*)$#', $key, $m);
                    if (isset($m[1]) && isset($m[2]) && $m[1] === $user) {
                        $questions[$m[1]][$m[2]] = $value;
                    }
                }
            }

            foreach ($questions as $key => $value) {
                $answer->value($key, $idEvaluation, $value);
            }

            $response = array(
                    'status'    => 200,
                    'message'   => 'Save'
                );

            echo json_encode($response);

        }

        public function createActionAsync()
        {
            $this->createAction();
        }
    }
}
