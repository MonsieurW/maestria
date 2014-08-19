<?php
/**
 * @var \Sohoa\Framework\Environnement $this;
 */

Hoa\Database\Dal::initializeParameters(array(
	'connection.list.default.dal' => Hoa\Database\Dal::PDO,
	'connection.list.default.dsn' => 'sqlite:hoa://Application/Database/Maestria.db',
	'connection.autoload' => 'default'
));

return array();
