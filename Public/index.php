<?php

namespace {

    use Sohoa\Framework\Framework;

    require_once __DIR__ . '/../vendor/autoload.php';

    $framework = new Framework();
    $framework->acl = new \Application\Maestria\Acl($framework);

    $framework->acl
        ->allow('app.api(.*)' , 'student')
        ->allow('app.professor(.*)' , 'professor');

    $framework->acl
        ->addUser('foo' , 'student')
        ->addUser('bar' , 'professor');

    $acl = $framework->acl->getAcl();

    var_dump($framework->acl->isAllow('foo' , 'app.api.domain'));
    var_dump($framework->acl->isAllow('bar' , 'app.professor.index'));

    //TODO : Make it more simple + kit for easy check in controller + check with $router->getTheRule()

    exit;
    try {
        $framework->run();
    } catch (\Hoa\Session\Exception\Expired $e) {
        $router = $framework->getRouter();
        $router->route('/');
        $framework->run();
    } catch (\Exception $e) {
        echo '<p>'.$e->getMessage().'</p>';
    }

}
