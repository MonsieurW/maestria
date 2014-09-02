<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Evaluation extends Generic
    {
        public function check()
        {
            if ($this->connected === false) {
                $this->redirector->redirect('mainlogin');
            }
        }

        public function indexAction($professor_id)
        {
            $evaluation      = new \Application\Model\Evaluation($professor_id);
            $mine            = $evaluation->mine();

            foreach ($mine as $i => $value) {
                $question       = new \Application\Model\Questions($value['idEvaluation']);
                $q              = $question->get();
                $mine[$i]['nb'] = count($q);
            }
            $this->data->pr   = $professor_id;
            $this->data->eval = $mine;
            $this->greut->render();
        }

        public function newAction($professor_id)
        {
            $dom                = new \Application\Model\Domain();
            $this->data->pr     = $professor_id;
            $this->data->domain = $dom->all();

            $this->greut->render();
        }

        public function createAction($professor_id)
        {
            $title          = $_POST['title'];
            $description    = $_POST['description'];
            $question       = array();

            foreach ($_POST as $key => $value) {
                if ($key[0] === 'q') {
                    preg_match('#q([0-9]+)_(.*)#', $key, $m);
                    $i                  = intval($m[1]);
                    $t                  = $m[2];
                    $k                  = explode('|', $value);
                    $question[$i][$t]   = $k[0];
                }
            }

            $question   = $this->filter($question);
            $evaluation = new \Application\Model\Evaluation($professor_id);
            $evId       = $evaluation->create($title, $description);
            $ques       = new \Application\Model\Questions($evId);

            foreach ($question as $q) {
                $ques->create($q['title'], $q['note'], $q['taxo'], $q['item1'], $q['item2']);
            }

           $this->redirector->redirect('showEvaluation', array('evaluation_id' => $evId, 'professor_id' => $professor_id));
        }

        protected function filter($array)
        {
            $return = array();
            foreach ($array as $i => $item) {
                $valid = false;
                if(    isset($item['title']) === true && $item['title'] !== ''
                    && isset($item['note'])  === true && $item['note']  !== ''
                    && isset($item['item1']) === true && $item['item1'] !== ''
                    && isset($item['item2']) === true && $item['item2'] !== ''
                    && isset($item['taxo'])  === true && $item['taxo']  !== ''
                )

                    $return[$i] = $item;
            }

            return $return;
        }

        public function showAction($professor_id, $evaluation_id)
        {
            $evaluation = new \Application\Model\Evaluation($professor_id);
            $question   = new \Application\Model\Questions($evaluation_id);
            $theme      = new \Application\Model\Theme();
            $domain     = new \Application\Model\Domain();
            $know       = new \Application\Model\Know();
            $e          = $evaluation->get($evaluation_id);
            $q          = $question->get();

           foreach ($q as $i => $value) {

                $item1                          = $know->get($value['refItem1'])[0];
                $item2                          = $know->get($value['refItem2'])[0];
                $q[$i]['item1']['themeValue']   = $theme->get($item1['refTheme'])['themeValue'];
                $q[$i]['item1']['domainValue']  = $domain->get($item1['refDomain'])['domainValue'];
                $q[$i]['item1']['item']         = $item1['item'];
                $q[$i]['item2']['themeValue']   = $theme->get($item2['refTheme'])['themeValue'];
                $q[$i]['item2']['domainValue']  = $domain->get($item2['refDomain'])['domainValue'];
                $q[$i]['item2']['item']         = $item2['item'];
           }

            $this->data->pr           = $professor_id;
            $this->data->id           = $e['idEvaluation'];
            $this->data->label        = $e['label'];
            $this->data->description  = $e['description'];
            $this->data->questions    = $q;
            $this->greut->render();
        }

        public function editAction($professor_id, $evaluation_id)
        {
            // TODO : Make and edit ? or an error here
            var_dump($professor_id, $evaluation_id);
        }

        public function destroyAction($evaluation_id, $professor_id)
        {
            $evaluation = new \Application\Model\Evaluation($professor_id);
            $ques       = new \Application\Model\Questions($evaluation_id);

            $evaluation->remove($evaluation_id);
            $ques->remove();

           $this->redirector->redirect('indexEvaluation', array('professor_id' => $professor_id));

        }

    }
}
