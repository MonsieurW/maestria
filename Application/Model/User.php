<?php
namespace Application\Model {

    class User
    {
        private $_layer = null;
        private $_user  = array();

        public function __construct()
        {
            //$this->_layer = \Hoa\Database\Dal::getLastInstance();
            $this->_user[1]  = array(
                'idProfil'      => 1,
                'login'         => 'Foobar',
                'isAdmin'       => true,
                'isModerator'   => true,
                'isProfessor'   => true,
                'user'          => 'Foo Bar 1',
                'class'         => array(
                    array('id' => 1 , 'name' => '2°K'),
                    array('id' => 2 , 'name' => '2°L'),
                    array('id' => 3 , 'name' => 'T°L'),
                ),
                'domain'        => array('Physique' , 'Chimie')
            );
            $this->_user[2]  = array(
                'idProfil'      => 2,
                'login'         => 'Hello',
                'isAdmin'       => true,
                'isModerator'   => true,
                'isProfessor'   => false,
                'user'          => 'Not a professor',
                'class'         => array(
                    array('id' => 1 , 'name' => '2°K'),
                    array('id' => 2 , 'name' => '2°L'),
                    array('id' => 3 , 'name' => 'T°L'),
                ),
                'domain'        => array()
            );
            $this->_user[3]  = array(
                'idProfil'      => 3,
                'login'         => 'Hello World',
                'isAdmin'       => false,
                'isModerator'   => false,
                'isProfessor'   => true,
                'user'          => 'Professor',
                'class'         => array(
                    array('id' => 1 , 'name' => '2°K'),
                    array('id' => 2 , 'name' => '2°L'),
                    array('id' => 3 , 'name' => 'T°L'),
                ),
                'domain'        => array('Math')
            );

        }

        public function sql($statement, $data = array())
        {
            $statement = strval($statement);

            if (!empty($data)) {
                return  $this->_layer->prepare($statement)->execute($data);
            }

            return  $this->_layer->query($statement);
        }

        public function exists($id)
        {
            return array_key_exists($id, $this->_user);
        }

        public function add($login, $name, $password)
        {
            
            return true;
        }

        public function get($id)
        {
           if(array_key_exists($id, $this->_user))
                return $this->_user[$id];

            return array();
        }

        public function all()
        {
            return $this->_user;
        }

        public function count()
        {
            return count($this->_user);
        }
    }
}
