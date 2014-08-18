<?php

/* @var $framework \Sohoa\Framework\Framework */

// Defines the defaults route
$this->get('/', 			array('as' => 'mainindex', 		'to' => 'Main#Index'));
$this->get('/login', 		array('as' => 'mainconnect', 	'to' => 'Main#Connect'));
$this->post('/login', 		array('as' => 'mainlogin', 		'to' => 'Main#Login'));
$this->get('/logout', 		array('as' => 'mainlogout', 	'to' => 'Main#Logout'));
$this->get('/register', 	array('as' => 'mainregister', 	'to' => 'Main#Register'));
$this->post('/register', 	array('as' => 'maincreate', 	'to' => 'Main#Create'));

$this
	->resource('professor')
	->resource('task')
	->resource('question');

$this
	->resource('student')
	->resource('answer');

$this
	->resource('classroom')
	->resource('student');


$this->resource('capabilites');
$this->resource('instruction');