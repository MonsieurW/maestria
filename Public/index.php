<?php
namespace {
    require_once __DIR__ . '/../vendor/autoload.php';

    $minutes = 60;
    session_set_cookie_params($minutes * 60 , '/');
    session_cache_expire($minutes);
    ini_set('session.gc_maxlifetime' , $minutes*60);

    try {
        $framework = new \Application\Maestria\Maestria();
        $framework->kit('redirector', new \Application\Controller\Kit\Redirection());
        $framework->setAcl();

        $router = $framework->getRouter();

        \Application\Maestria\Log::info(
            $router->getMethod().': /'.$router->getURI(),
            array(
                \Hoa\Http\Runtime::getData(),
                array('async' => $router->isAsynchronous())
            )
        );

        $framework->run();
    } catch (\Hoa\Session\Exception\Expired $e) {

        \Application\Maestria\Log::debug('Expired');
        $framework->getRouter()->route('/');
        $framework->run();

    } catch (\Exception $e) {
        
        \Application\Maestria\Log::error(
            $e->getMessage(),
            array($e->getFile().':'.$e->getLine().'#'.$e->getCode())
        );
        echo '<p>'.$e->getMessage().'</p>';
    }

}
