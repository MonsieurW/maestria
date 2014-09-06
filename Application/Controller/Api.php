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
            $questions  = new \Application\Model\Questions($eval);
            $answer     = new \Application\Model\Answer();
            $answers    = array();
            $questions  = $questions->all();

            foreach ($answer->getEvaluation($eval) as $key => $value) {
              $answers[$value['refUser']] = json_decode($value['note'], true);
            }

            foreach ($questions as $key => $question) {

                $questions[$key]['item1'] = $item->getText($question['refItem1']);
                $questions[$key]['item2'] = $item->getText($question['refItem2']);

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

            $this->data->users = $eleve;
            $this->data->questions = $questions;
            $this->data->answers = $answers;

            // TODO : Add Theme Domain ItemText

            $this->greut->render('hoa://Application/View/Evaluate/Control.tpl.php');
        }

        public function domainActionAsync()
        {
            $domaine = new \Application\Model\Domain();

            echo json_encode($domaine->all());
        }

        public function levelActionAsync()
        {
          $lvl = array();

          for($i = 1; $i <= 15; $i++)
            $lvl[] = array('value' => $i, 'text' => $i);

          echo json_encode($lvl);
        }

        public function typeActionAsync()
        {
          $type = array(
            array('value' => 0, 'text' => 'Connaissance'),
            array('value' => 1, 'text' => 'Compétence')
          );

          echo json_encode($type);
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
