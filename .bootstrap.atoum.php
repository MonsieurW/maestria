<?php
require_once __DIR__ . '/vendor/autoload.php';

\atoum\autoloader::get()->addDirectory('Camael\Api\Tests\Unit\Asserters', __DIR__ . '/Tests/Unit/Asserters');
\atoum\autoloader::get()->addDirectory('Camael\Api\Tests\Unit\Mock', __DIR__ . '/Tests/Unit/Mock');
\atoum\autoloader::get()->addDirectory('Application\Controller', __DIR__ . '/Application/Controller');
\atoum\autoloader::get()->addDirectory('Application\Maestria', __DIR__ . '/Application/Maestria');
