<?php
namespace Application\Acl\Eleve { 
    class Main {}
}

namespace Application\Acl\Eleve\Tests\Unit {
    /**
     * @engine inline
     */
    class Main extends \atoum\test
    {
        public function beforeTestMethod($testMethod)
        {
            $this->define->request = '\Camael\Api\Tests\Unit\Asserters\Request';
        }

        public function testIndex()
        {
            $request = $this->request;
            $html    = $request->get('/')->html;
            $html    = $request->post('/login', ['user' => 'eleve' , 'password' => 'eleve'])->html;

            // echo $request;

            $this->if($item = $html->xquery('//a[@href="/user/4"]')[0])
                ->string(trim($item->nodeValue))->isIdenticalTo('Eleve')
            ;  

            $this->if($item = $html->xquery('//ul[@class="nav navbar-nav"]/li/a/i'))
                ->integer(count($item))->isIdenticalTo(0)
            ;
        }
    }
}
