<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Domain extends Generic
    {
        public function indexAction()
        {
            
            if($this->_allIsGood === false)
                return;
            
            $classe             = new \Application\Model\Domain();
            $this->data->classe = $classe->all();

            $this->greut->render();
        }

        public function createActionAsync()
        {
            if($this->_allIsGood === false)
                return;
            
            $id     = (isset($_POST['pk']))     ? $_POST['pk']      : null;
            $value  = (isset($_POST['value']))  ? $_POST['value']   : null;
            $mode   = (isset($_POST['mode']))   ? $_POST['mode']    : 'update';
            $classe = new \Application\Model\Domain();

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
    }
}
