<?php
namespace Camael\Api\Tests\Unit\Mock;

class Redirect extends \Application\Controller\Kit\Redirection
{
	public function redirect($ruleId, array $data = array(), $secured = null, $status = 302)
    {
        $uri = $this->router->unroute($ruleId, $data, $secured);

        $response = $this->view->getOutputStream();
        $response->sendHeader('Location', $uri, true, $status);
    }

    public function url($uri, $status = 302)
    {
        $response = $this->view->getOutputStream();
        $response->sendHeader('Location', $uri, true, $status);
    }

}