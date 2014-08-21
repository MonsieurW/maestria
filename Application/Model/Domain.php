<?php
namespace Application\Model {

    class Domain
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
            $value = strtolower($value);

            if($this->exists($value) === false)
                $this->sql('INSERT INTO domain VALUES(null, :v);' , array('v' => $value));


        }

        public function exists($value)
        {
            return false; // TODO : Make it
        }

        public function update($id, $value)
        {
            $value = strtolower($value);

            $this->sql('UPDATE FROM domain SET value = :v WHERE idDomain = :i', array('v' => $value, 'i' => $id));

        }

        public function getID($value)
        {
            $value = strtolower($value);
            $sql = 'SELECT * FROM domain WHERE value = :v';
            $sql = $this->sql($sql, array('v' => $value))->fetchAll();

            if(count($sql) === 1)
                return $sql[0]['idDomain'];

            return null;
        }

    }
}
