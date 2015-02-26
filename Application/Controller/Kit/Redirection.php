<?php
namespace Application\Controller\Kit {

    class Redirection extends \Sohoa\Framework\Kit\Redirector
    {

        public function url($uri, $status = 302)
        {
            $response = $this->view->getOutputStream();
            $response->sendHeader('Location', $uri, true, $status);

            return;
        }

        public function redirect($ruleId, array $data = array(), $secured = null, $status = 302)
        {
            $uri = $this->router->unroute($ruleId, $data, $secured);

            $response = $this->view->getOutputStream();
            $response->sendHeader('Location', $uri, true, $status);

            return;
        }

        public function exit()
        {
        	exit;
        }
    }
}
