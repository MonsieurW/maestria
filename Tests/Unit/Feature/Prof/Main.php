<?php
namespace Application\Acl\Prof { 
    class Main {}
}

namespace Application\Acl\Prof\Tests\Unit {
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
            $html    = $request->post('/login', ['user' => 'prof' , 'password' => 'prof'])->html;

            // echo $request;

            $this->if($item = $html->xquery('//a[@href="/user/3"]')[0])
                ->string(trim($item->nodeValue))->isIdenticalTo('Professor')
            ;  

            $this->if($item = $html->xquery('//ul[@class="nav navbar-nav"]/li/a/i'))
                ->integer(count($item))->isIdenticalTo(0) // TODO : Need to see that
            ;
        }
    }
}
