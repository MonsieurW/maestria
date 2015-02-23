<?php
/**
 * @var \Sohoa\Framework\Environnement $this;
 */

Hoa\Database\Dal::initializeParameters(array(
	'connection.list.default.dal' => Hoa\Database\Dal::PDO,
	'connection.list.default.dsn' => 'sqlite:hoa://Application/Database/Maestria.db',
	'connection.list.test.dal' => Hoa\Database\Dal::PDO,
	'connection.list.test.dsn' => 'sqlite:hoa://Application/Database/Maestria-test.db',
	'connection.autoload' => 'default',
));

return array();
