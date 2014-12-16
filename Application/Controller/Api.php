<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Api extends Kit
    {
        public function classAction()
        {
            $classe = new \Application\Model\Classe();
            $api    = array();

            foreach ($classe->all() as $value) {
                $api[] = $value['value'];
            }

            echo json_encode($api);

        }

        public function domainAction()
        {

            $classe = new \Application\Model\Domain();
            $api    = array();

            foreach ($classe as $value) {
                $api[] = $value['value'];
            }

            echo json_encode($api);
        }

        public function classeActionAsync($classe)
        {

          $eleve = new \Application\Model\UserClass();
          $eleve = $eleve->getUsers($classe);
          echo json_encode($eleve);
        }

        public function classeallActionAsync($classe = null)
        {
            $eleve = new \Application\Model\Classe();

            echo json_encode($eleve->All());
        }

        public function controlActionAsync($clas, $eval)
        {

            $eleve      = new \Application\Model\UserClass();
            $eleve      = $eleve->getEleves($clas);
            $item       = new \Application\Model\Know();
            $themex     = new \Application\Model\Theme();
            $questions  = new \Application\Model\Questions($eval);
            $answer     = new \Application\Model\Answer();
            $answers    = array();
            $questions  = $questions->all();

            foreach ($answer->getEvaluation($eval) as $key => $value) {
              $answers[$value['refUser']] = json_decode($value['note'], true);
            }

            foreach ($questions as $key => $question) {
                $questions[$key]['item1']     = $item->getText($question['refItem1']);
                $questions[$key]['item2']     = $item->getText($question['refItem2']);
                $questions[$key]['theme1']    = $item->getTheme($question['refItem1']);
                $questions[$key]['theme1-c']  = $themex->getValue($item->getTheme($question['refItem1']));
                $questions[$key]['theme2']    = $item->getTheme($question['refItem2']);
                $questions[$key]['theme2-c']  = $themex->getValue($item->getTheme($question['refItem2']));

                switch ($question['taxoPrincipal']) {
                  case '1':
                    $questions[$key]['taxoPrincipal'] = 'Connaissance';
                    $questions[$key]['taxoPrincipal-c'] = 'success';
                    break;
                  case '2':
                    $questions[$key]['taxoPrincipal'] = 'Compréhension';
                    $questions[$key]['taxoPrincipal-c'] = 'info';
                    break;
                  case '3':
                    $questions[$key]['taxoPrincipal'] = 'Application';
                    $questions[$key]['taxoPrincipal-c'] = 'warning';
                    break;
                  case '4':
                  default:
                    $questions[$key]['taxoPrincipal'] = 'Analyse';
                    $questions[$key]['taxoPrincipal-c'] = 'danger';
                    break;
                }
            }

            $sticker = array();
            foreach ($answers as $idProfil => $value) {
                $stats = new \Application\Model\DomainStats();
                $stats = $stats->getDomainStatistic($idProfil);

                foreach ($questions as $key => $question) {
                    $t1 = $question['theme1'];
                    $t2 = $question['theme2'];

                    if(isset($stats[$t1])){
                        $t1 = $stats[$t1];
                        $sticker[$idProfil][$question['idQuestion']]['t1'] = array_sum($t1) / count($t1);
                    }
                    if(isset($stats[$t2])){
                        $t2 = $stats[$t2];
                        $sticker[$idProfil][$question['idQuestion']]['t2'] = array_sum($t2) / count($t2);
                    }
                }


            }


            $this->data->sticker    = $sticker;
            $this->data->users      = $eleve;
            $this->data->questions  = $questions;
            $this->data->answers    = $answers;

            $this->greut->render('hoa://Application/View/Evaluate/Control.tpl.php');
        }

        public function domainActionAsync()
        {
            $domaine = new \Application\Model\Domain();

            echo json_encode($domaine->all());
        }

        public function domaineActionAsync()
        {

          $type    = array();
          $domaine = new \Application\Model\Domain();

          foreach ($domaine->all() as $value) {
            $type[] = array('value' => $value['idDomain'], 'text' => $value['domainValue']);
          }

          echo json_encode($type);
        }

        public function themeActionAsync()
        {

          $type    = array();
          $domaine = new \Application\Model\Theme();

          foreach ($domaine->all() as $value) {
            $type[] = array('value' => $value['idTheme'], 'text' => $value['themeValue']);
          }

          echo json_encode($type);
        }

        public function usersActionAsync()
        {
          $users = array();
          $model = new \Application\Model\User();

          foreach ($model->getEleves() as $user) {
            $users[] = array(
              'id'  => $user['idProfil'],
              'user'=> $user['user']
            );
          }

          echo json_encode($users);

        }

        public function knowActionAsync()
        {
          $domain   = (isset($_POST['domain'])) ? $_POST['domain'] : null;
          $d        = new \Application\Model\Domain();
          $idDomain = $d->getID(strtolower($domain));
          $q        = new \Application\Model\Know();

          if ($domain === null) {
            throw new \Exception("Domain not found in the request");
          }

          if ($idDomain === null) {
            throw new \Exception("Domain not found in database");
          }

          $know = $q->getWithDomain($idDomain);

          echo json_encode($know);

        }
    }
}
