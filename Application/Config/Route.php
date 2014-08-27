<?php
/* @var $framework \Sohoa\Framework\Framework */
$this->setRessource(\Sohoa\Framework\Router::REST_SHOW, null, null, '/(?<%s>[^/]+)');
$this->setRessource(\Sohoa\Framework\Router::REST_EDIT, null, null, '/(?<%s>[^/]+)/edit');
$this->setRessource(\Sohoa\Framework\Router::REST_UPDATE, null, 'post', '/(?<%s>[^/]+)/update');
$this->setRessource(\Sohoa\Framework\Router::REST_DESTROY, null, 'get', '/(?<%s>[^/]+)/destroy');

$this
    ->resource('professor' ,                                array('only' => array('index' , 'show'))) //professor_id = user_id with option professor
    ->resource('evaluation');

$this
    ->resource('evaluate');

$this
    ->resource('student')
    ->resource('answer'); // student = user & answer = evaluation TODO : Make it

$this->resource('theme',                                    array('only' => array('index', 'create')));
$this->resource('classroom',                                array('only' => array('index', 'create', 'edit', 'update')));
$this->resource('domain',                                   array('only' => array('index', 'create')));
$this->resource('know',                                     array('only' => array('index', 'create')));

$this->get('/',                                             array('as' => 'mainindex',      'to' => 'Main#Index'));
$this->get('/login',                                        array('as' => 'mainconnect',    'to' => 'Main#Connect'));
$this->post('/login',                                       array('as' => 'mainlogin',      'to' => 'Main#Login'));
$this->get('/logout',                                       array('as' => 'mainlogout',     'to' => 'Main#Logout'));
$this->get('/register',                                     array('as' => 'mainregister',   'to' => 'Main#Register'));
$this->post('/register',                                    array('as' => 'maincreate',     'to' => 'Main#Create'));
$this->get('/user/',                                        array('as' => 'profilall',      'to' => 'Main#Profilall'));
$this->get('/user/(?<id>[^/]+)/?',                          array('as' => 'profiluser',     'to' => 'Main#Profil'));
$this->get('/user/(?<id>[^/]+)/edit',                       array('as' => 'profiledit',     'to' => 'Main#Profiledit'));
$this->post('/user/(?<id>[^/]+)/?',                         array('as' => 'profilupdate',   'to' => 'Main#Profilupdate'));
$this->get('/api/cap',                                      array('as' => 'apicap',         'to' => 'Api#Cap'));
$this->get('/api/domain/',                                  array('as' => 'apidomain',      'to' => 'Api#Domain'));
$this->get('/api/class/',                                   array('as' => 'apiclasse',      'to' => 'Api#Classeall'));
$this->get('/api/class/(?<classe>.*)',                      array('as' => 'apiclass',       'to' => 'Api#Classe'));
$this->get('/api/control/(?<user>[^/]+)/eval/(?<eval>.*)',  array('as' => 'apicontrol',     'to' => 'Api#Control'));
$this->get('/api/theme/?',                                  array('as' => 'apitheme',       'to' => 'Api#Theme'));
$this->get('/api/domaine/?',                                array('as' => 'apidomaine',     'to' => 'Api#Domaine'));
$this->get('/api/level/?',                                  array('as' => 'apilevel',       'to' => 'Api#Level'));
$this->get('/api/type/?',                                   array('as' => 'apitype',        'to' => 'Api#Type'));
$this->get('/api/users/?',                                  array('as' => 'apiusers',       'to' => 'Api#Users'));
