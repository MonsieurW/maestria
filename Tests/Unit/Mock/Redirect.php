<?php
namespace Camael\Api\Tests\Unit\Mock;

class Redirect extends \Application\Controller\Kit\Redirection
{
	public function redirect($ruleId, array $data = array(), $secured = null, $status = 302)
    {
        exit;
    }

    public function url($uri, $status = 302)
    {
        var_dump($ruleId);
    }

}