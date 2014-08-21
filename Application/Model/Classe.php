<?php
namespace Application\Model {

    class Classe
    {
        private $_layer = null;

        public function __construct()
        {
            $this->_layer = \Hoa\Database\Dal::getLastInstance();
            
        }

        public function sql($statement, $data = array())
        {
            $statement = strval($statement);

            if (!empty($data)) {
                return  $this->_layer->prepare($statement)->execute($data);
            }

            return  $this->_layer->query($statement);
        }

        public function add($value)
        {
            if($this->exists($value) === false)
                $this->sql('INSERT INTO class VALUES(null, :v);' , array('v' => $value));


        }

        public function exists($value)
        {
            return false; // TODO : Make it
        }

        public function update($id, $value)
        {
            $this->sql('UPDATE FROM class SET value = :v WHERE idClass = :i', array('v' => $value, 'i' => $id));

        }

        public function getID($value)
        {

            $sql = 'SELECT * FROM class WHERE value = :v';
            $sql = $this->sql($sql, array('v' => $value))->fetchAll();

            if(count($sql) === 1)
                return $sql[0]['idClass'];

            return null;
        }

    }
}
