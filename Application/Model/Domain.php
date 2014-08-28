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

            if ($this->exists($value) === false) {
                $this->sql('INSERT INTO domain VALUES(null, :v);' , array('v' => $value));

               return $this->_layer->lastInsertId();
            }
        }

        public function exists($value)
        {
            $sql = 'SELECT COUNT(*) FROM domain WHERE domainValue = :id';
            $smt = $this->sql($sql, array('id' => $value))->fetchColumn(0);

            return (intval($smt) > 0);
        }

        public function update($id, $value)
        {
            $value = strtolower($value);

            $this->sql('UPDATE domain SET domainValue = :v WHERE idDomain = :i', array('v' => $value, 'i' => $id));
        }

        public function getID($value)
        {
            $value = strtolower($value);
            $sql = 'SELECT * FROM domain WHERE domainValue = :v';
            $sql = $this->sql($sql, array('v' => $value))->fetchAll();

            if(count($sql) === 1)

                return $sql[0]['idDomain'];

            return null;
        }

        public function all()
        {
           $sql = 'SELECT * FROM domain';

           return $this->sql($sql)->fetchAll();
        }
    }
}
