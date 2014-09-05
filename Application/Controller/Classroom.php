<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Classroom extends Generic
    {

        public function indexAction()
        {
            $classe             = new \Application\Model\Classe();
            $this->data->classe = $classe->all();

            $this->greut->render();

            // TODO : Make pages
        }

        public function createActionAsync()
        {
            $id     = (isset($_POST['pk']))     ? $_POST['pk']      : null;
            $value  = (isset($_POST['value']))  ? $_POST['value']   : null;
            $mode   = (isset($_POST['mode']))   ? $_POST['mode']    : 'update';
            $classe = new \Application\Model\Classe();

            switch ($mode) {
                case 'delete';
                    $classe->destroy($id);
                    break;
                case 'new';
                    $classe->add($value);
                    break;
                case 'update':
                default:
                    $classe->update($id, $value);
            }
        }

        public function updateActionAsync($classroom_id)
        {

            $mode   = (isset($_POST['mode']))   ? $_POST['mode']    : 'nothing';
            $id     = (isset($_POST['id']))     ? $_POST['id']      : 'nothing';
            $model  = new \Application\Model\UserClass();

            if ($mode !== 'nothing') {
                switch ($mode) {
                    case 'add':
                        $model->associate($id, $classroom_id);
                        break;
                    case 'remove':
                        $model->remove($id, $classroom_id);
                        break;
                    default:
                        break;
                }
            }
        }

        public function editAction($classroom_id)
        {
           $model   = new \Application\Model\UserClass();
           $users   = array();
           $model   = $model->getUsers($classroom_id);

           foreach ($model as $m) {
                if ($m['isProfessor'] === '0' && $m['isModerator'] === '0' && $m['isAdmin'] === '0') {
                    $users[] = $m;
                }
           }

           $this->data->users   = $users;

           $this->greut->render();
        }
    }
}
