<?php
namespace Application\Controller\Tests\Unit {

    class Main extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->request = '\Camael\Api\Tests\Unit\Asserters\Request';
            //$this->define->html    = '\Camael\Api\Tests\Unit\Asserters\Html';
        }

        // index   => List all users
        public function testIndex()
        {
            $request = $this->request;
            $html    = $request->get('/')->html;

            // echo $request->echoBody();

            //echo $get;

            $html->hasError()->istrue();
            $html->error->string[0]->match('#Tag footer invalid#');
        }
    }
}
