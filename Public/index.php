<?php

namespace {

    use Sohoa\Framework\Framework;

    require_once __DIR__ . '/../vendor/autoload.php';

    $framework = new Framework();

    try {
        $framework->run();
    } catch (\Hoa\Session\Exception\Expired $e) {
        $router = $framework->getRouter();
        $router->route('/');
        $framework->run();
    }

}
