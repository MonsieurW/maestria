<?php

/* @var $framework \Sohoa\Framework\Framework */

/*

  protected  static $_restfulRoutes = array(
            self::REST_SHOW    => array(self::ROUTE_ACTION => 'show', self::ROUTE_VERB => 'get', self::ROUTE_URI_PATTERN => '/(?<%s>[^/]+)'),
            self::REST_EDIT    => array(self::ROUTE_ACTION => 'edit', self::ROUTE_VERB => 'get', self::ROUTE_URI_PATTERN => '/(?<%s>[^/]+)/edit'),
            self::REST_UPDATE  => array(self::ROUTE_ACTION => 'update', self::ROUTE_VERB => 'patch', self::ROUTE_URI_PATTERN => '/(?<%s>[^/]+)'),
            self::REST_DESTROY => array(self::ROUTE_ACTION => 'destroy', self::ROUTE_VERB => 'delete', self::ROUTE_URI_PATTERN => '/(?<%s>[^/]+)'),
        );
        */
$this->setRessource(\Sohoa\Framework\Router::REST_SHOW, null, null, '/(?<%s>[^/]+)');
$this->setRessource(\Sohoa\Framework\Router::REST_EDIT, null, null, '/(?<%s>[^/]+)/edit');
$this->setRessource(\Sohoa\Framework\Router::REST_UPDATE, null, 'post', '/(?<%s>[^/]+)/update');
$this->setRessource(\Sohoa\Framework\Router::REST_DESTROY, null, 'get', '/(?<%s>[^/]+)/destroy');

// Defines the defaults route

$this
	->resource('professor' , array('only' => array('index' , 'show'))) //professor_id = user_id with option professor
	->resource('evaluation');

$this
	->resource('evaluate', array('only' => array('show', 'update'))); // ID Evaluation
	
$this
	->resource('student')
	->resource('answer'); // ID Evaluation

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
$this->get('/api/cap',					array('as' => 'apiclass',		'to' => 'Api#Cap')); // TODO : Make an API
//$this->get('/api/domain',				array('as' => 'apidomain',		'to' => 'Api#Domain'));  // TODO : Make an API

/*
$this
	->resource('classroom')
	->resource('student');


$this->resource('capabilites');
$this->resource('instruction');*/