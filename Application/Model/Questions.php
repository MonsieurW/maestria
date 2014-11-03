<?php
namespace Application\Model {

    class Questions
    {
        private $_layer = null;
        private $_eval  = null;

        public function __construct($evaluation_id = null)
        {
            $this->_layer = \Hoa\Database\Dal::getLastInstance();
            $this->_eval  = $evaluation_id;
        }

        public function create($title, $note, $taxo, $item1, $item2)
        {
            $sql = 'INSERT INTO questions VALUES (null, :eval, :title, :note, :taxo, :i1, :i2)';
            $this->sql($sql, array(
                'eval'  => $this->_eval,
                'title' => $title,
                'note'  => intval($note),
                'taxo'  => intval($taxo),
                'i1'    => intval($item1),
                'i2'    => intval($item2)
            ));

            return $this->_layer->lastInsertId();
        }

        public function all()
        {
            return $this
                        ->sql('SELECT * FROM questions WHERE refEvaluation = :e', array('e' => $this->_eval))
                        ->fetchAll();

        }

        public function update($id, $title, $note, $taxo, $i1, $i2)
        {
            $update = 'UPDATE questions SET title = :t, note  = :n, taxoPrincipal = :p, refItem1 = :r1, refItem2 = :r2 WHERE idQuestion = :id';

            $this->sql($update, array(
                'id' => $id,
                't'  => $title,
                'n'  => intval($note),
                'p'  => intval($taxo),
                'r1' => intval($i1),
                'r2' => intval($i2)
            ));
    
        }

        public function get()
        {

            return $this
                        ->sql('SELECT * FROM questions WHERE refEvaluation = :e', array('e' => $this->_eval))
                        ->fetchAll();
        }

        public function remove()
        {
            $this->sql('DELETE FROM questions WHERE refEvaluation = :e', array('e' => $this->_eval));
        }

        public function exists($idQuestion)
        {
            $sql = 'SELECT COUNT(*) FROM questions WHERE idQuestion = :q';
            $smt = $this->sql($sql, array('q' => $idQuestion))->fetchColumn(0);

            return (intval($smt) > 0);
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
