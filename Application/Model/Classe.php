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

        public function all()
        {
            return $this->sql('SELECT * FROM class')->fetchAll();
        }

        public function destroy($id)
        {
            $this->sql('DELETE FROM class WHERE idClass = :i', array('i' => $id));
        }

        public function exists($value)
        {
            $sql = 'SELECT COUNT(*) FROM class WHERE value = :id';
            $smt = $this->sql($sql, array('id' => $value))->fetchColumn(0);

            return (intval($smt) > 0);
        }

        public function update($id, $value)
        {
            $this->sql('UPDATE class SET value = :v WHERE idClass = :i', array('v' => $value, 'i' => $id));
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
