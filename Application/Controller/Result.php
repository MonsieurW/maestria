<?php

namespace Application\Controller {

    class Result extends Generic
    {

        public function indexAction($classroom_id) {
           
            if($this->_allIsGood === false)
                return;
            

            $this->greut->render();
        }
    }
}