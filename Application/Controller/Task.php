<?php

namespace Application\Controller {

    use Sohoa\Framework\Kit;

    class Task extends Kit
    {
        public function indexAction($professor_id)
        {
            var_dump($professor_id);
        }

        public function showAction($professor_id, $task_id)
        {
        
        }
        
    }
}
