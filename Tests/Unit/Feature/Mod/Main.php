<?php
namespace Application\Acl\Mod { 
    class Main {}
}

namespace Application\Acl\Mod\Tests\Unit {
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
            $html    = $request->post('/login', ['user' => 'mod' , 'password' => 'mod'])->html;

            // echo $request;

            $this->if($item = $html->xquery('//a[@href="/user/2"]')[0])
                ->string(trim($item->nodeValue))->isIdenticalTo('Moderator')
            ;  

            $this->if($item = $html->xquery('//ul[@class="nav navbar-nav"]/li/a/i'))
                ->integer(count($item))->isIdenticalTo(0) // TODO : Need to see that
            ;
        }
    }
}
