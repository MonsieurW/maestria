<?php
namespace Application\Controller\Kit {

    class Redirection extends \Sohoa\Framework\Kit\Redirector
    {

        public function url($uri, $status = 302)
        {
            $response = $this->view->getOutputStream();
            $response->sendHeader('Location', $uri, true, $status);

            exit;
        }
    }
}
