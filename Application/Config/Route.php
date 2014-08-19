<?php

/* @var $framework \Sohoa\Framework\Framework */

// Defines the defaults route

$this
	->resource('professor' , array('only' => array('index' , 'show')))
	->resource('task')
	->resource('question');

$this->get('/', 						array('as' => 'mainindex', 		'to' => 'Main#Index'));
$this->get('/login', 					array('as' => 'mainconnect', 	'to' => 'Main#Connect'));
$this->post('/login', 					array('as' => 'mainlogin', 		'to' => 'Main#Login'));
$this->get('/logout', 					array('as' => 'mainlogout', 	'to' => 'Main#Logout'));
$this->get('/register', 				array('as' => 'mainregister', 	'to' => 'Main#Register'));
$this->post('/register', 				array('as' => 'maincreate', 	'to' => 'Main#Create'));
$this->get('/user/', 					array('as' => 'profilall',	 	'to' => 'Main#Profilall'));
$this->get('/user/(?<id>[^/]+)/?', 		array('as' => 'profiluser', 	'to' => 'Main#Profil'));
$this->get('/user/(?<id>[^/]+)/edit', 	array('as' => 'profiledit', 	'to' => 'Main#Profiledit'));
$this->post('/user/(?<id>[^/]+)/?', 	array('as' => 'profilupdate', 	'to' => 'Main#Profilupdate'));



/*$this
	->resource('student')
	->resource('answer');

$this
	->resource('classroom')
	->resource('student');


$this->resource('capabilites');
$this->resource('instruction');*/