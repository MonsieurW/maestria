<?php

namespace {

    use Sohoa\Framework\Framework;

    require_once __DIR__ . '/../vendor/autoload.php';

    try {

        $framework = new Framework();
        $framework->run();

    } catch (\Hoa\Session\Exception\Expired $e) {

    }

}
