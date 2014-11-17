<?php
namespace {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ .'/../Application/Maestria/Maestria.php'; // Need to use autoload xD


    session_set_cookie_params(3600 , '/');
    session_cache_expire(3600);

    try {
        $framework = new \Application\Maestria\Maestria();
        $framework->kit('redirector', new \Application\Controller\Kit\Redirection());
        $framework->setAcl();

        \Application\Maestria\Log::info('GET : /'.$framework->getRouter()->getURI());

        $framework->run();
    } catch (\Hoa\Session\Exception\Expired $e) {
        \Application\Maestria\Log::info('Expired');
        $framework->getRouter()->route('/');
        $framework->run();
    } catch (\Exception $e) {
        echo '<p>'.$e->getMessage().'</p>';
    }

}
