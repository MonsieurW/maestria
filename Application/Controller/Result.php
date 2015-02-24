<?php

namespace Application\Controller {

    class Result extends Generic
    {

        public function indexAction($classroom_id) {
            var_dump($classroom_id);

            $this->greut->render();
        }
    }
}