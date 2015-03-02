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
            $html    = $request->get('/')->html;


            $this
                ->if($item = $html->xquery('//div')[0])
                ->variable($item) ->isNotNull()
                ->object($item) ->isInstanceOf('\DOMElement')
                ->string($item->nodeValue) ->contains('Maestria')
            ;

            // Has login form
            $this
                ->if($item = $html->xquery('//p')[0])
                ->variable($item) ->isNotNull()
                ->string($item->nodeValue) ->contains('admin/admin')
            ; 

            $html = $request->post('/login', ['user' => 'admin' , 'password' => 'admin'])->html;

            $this->if($item = $html->xquery('//a[@href="/user/1"]')[0])
                ->string(trim($item->nodeValue))->isIdenticalTo('Administrateur')
            ;  
            
            $this->if($item = $html->xquery('//div[@class="rowing well"]'))
                ->integer(count($item))->isIdenticalTo(15)
            ;
        }
    }
}
