<?php
namespace Application\Controller\Tests\Unit {

    class Main extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->request = '\Camael\Api\Tests\Unit\Asserters\Request';
        }

        // index   => List all users
        public function testIndex()
        {
            $request = $this->request;
            $get     = $request->get('/');

            echo $request->echoBody();
        }
    }
}
