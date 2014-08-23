<?php
namespace Application\Model {

    class Evaluation
    {
        private $_layer = null;
        private $_prof  = null;

        public function __construct($professor_id)
        {
            $this->_layer = \Hoa\Database\Dal::getLastInstance();
            $this->_prof  = $professor_id;
        }

        public function create($label, $description)
        {
            $this->sql('INSERT INTO evaluation VALUES(null, :r, :l, :d, :t);', array(
                'r' => $this->_prof,
                'l' => $label,
                'd' => $description,
                't' => time()
            ));
    
            return $this->_layer->lastInsertId();
        }

        public function all()
        {
            return $this->sql('SELECT * FROM evaluation')->fetchAll();
        }

        public function mine()
        {
            return $this
                ->sql('SELECT * FROM evaluation WHERE refUser = :e', array('e' => $this->_prof))
                ->fetchAll();
        }

        public function get($id)
        {
            $all = $this
                        ->sql('SELECT * FROM evaluation WHERE idEvaluation = :e', array('e' => $id))
                        ->fetchAll();
                        
            if(isset($all[0]))
                return $all[0];

            return array();
        }

        public function remove($id)
        {
            $this->sql('DELETE FROM evaluation WHERE idEvaluation = :e', array('e' => $id));
        }

        public function sql($statement, $data = array())
        {
            $statement = strval($statement);

            if (!empty($data)) {
                return  $this->_layer->prepare($statement)->execute($data);
            }

            return  $this->_layer->query($statement);
        }

        
    }
}
