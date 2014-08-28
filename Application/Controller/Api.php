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

            echo '["Amsterdam","London","Paris","Washington","New York","Los Angeles","Sydney","Melbourne","Canberra","Beijing","New Delhi","Kathmandu","Cairo","Cape Town","Kinshasa"]';

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

            $eleve = new \Application\Model\UserClass();
            $eleve = $eleve->getUsers($clas);
            $question = new \Application\Model\Questions($eval);

            $this->data->users = $eleve;
            $this->data->questions = $question->all();

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

          for($i = 1; $i <= 9; $i++)
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

        public function capActionAsync()
        {
            $this->capAction();
        }

        public function capAction()
        {

           echo '[
  {
    "year": "1964",
    "value": "My Fair Lady",
    "tokens": [
      "My",
      "Fair",
      "Lady"
    ]
  },
  {
    "year": "1965",
    "value": "The Sound of Music",
    "tokens": [
      "The",
      "Sound",
      "of",
      "Music"
    ]
  },
  {
    "year": "1966",
    "value": "A Man for All Seasons",
    "tokens": [
      "A",
      "Man",
      "for",
      "All",
      "Seasons"
    ]
  }]';

        }

    }
}
