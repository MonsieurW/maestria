<?php
namespace Application\Controller\Tests\Unit {

    class Main extends \atoum\test
    {
        /**
         * @engine inline
         */
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
                ->variable($item)           ->isNotNull()
                ->object($item)             ->isInstanceOf('\DOMElement')
                ->string($item->nodeValue)  ->contains('Maestria')
            ;

            // Has login form
            $this
                ->if($item = $html->xquery('//p')[0])
                ->variable($item)           ->isNotNull()
                ->string($item->nodeValue)  ->contains('admin/admin')
            ; 

            $html = $request->post('/login', ['user' => 'admin' , 'password' => 'admin'])->html;

            // echo $request;

            $this->if($item = $html->xquery('//a[@href="/user/1"]')[0])
                ->string(trim($item->nodeValue))->isIdenticalTo('Administrateur')
            ;  
            
            $this->if($item = $html->xquery('//div[@class="rowing well"]'))
                ->integer(count($item))->isIdenticalTo(15)
            ; 

            $this->if($item = $html->xquery('//ul[@class="nav navbar-nav"]/li/a/i'))
                ->integer(count($item))->isIdenticalTo(4)
                ->object($item[0])->isInstanceOf('\DOMElement')
                ->string($item[0]->getAttribute('class'))->isIdenticalTo('fa fa-bookmark')
                ->string($item[1]->getAttribute('class'))->isIdenticalTo('fa fa-desktop')
                ->string($item[2]->getAttribute('class'))->isIdenticalTo('fa fa-road')
                ->string($item[3]->getAttribute('class'))->isIdenticalTo('fa fa-paw')
            ;
        }
    }
}
