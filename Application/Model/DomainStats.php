<?php
namespace Application\Model {

    class DomainStats
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

        public function getDomainStatistic($uid)
        {
            // 1. Get All question
            $this->sql('CREATE TEMPORARY TABLE IF NOT EXISTS TempTable(id INTEGER, item TEXT, idItem);');
            $this->sql('INSERT INTO TempTable SELECT idQuestion AS id, item, refTheme as idItem FROM questions as q, connaissance as k WHERE q.refItem1 = k.idConnaissance;');
            $this->sql('INSERT INTO TempTable SELECT idQuestion AS id, item, refTheme as idItem FROM questions as q, connaissance as k WHERE q.refItem2 = k.idConnaissance;');

            $questions      = $this->sql('SELECT * FROM TempTable')->fetchAll();
            $questByTheme   = array();
            $r              = array();

            foreach ($questions as $value) {
                $questByTheme[intval($value['id'])][] = $value['idItem'];
                $r[intval($value['idItem'])][] = $value['item'];

            }

            // 2. Get All answers for this user
            $answers = new Answer();
            $answers = $answers->getStudentEvaluation($uid);
            $notes   = array();

            foreach ($answers as $value) {
                $n = json_decode($value['note'], true);
                foreach ($n as $key => $value) {
                    $notes[$key] = $value;
                }
            }

            $domainNotes = array();

            foreach ($notes as $id => $note) {
                if(isset($questByTheme[$id])) {
                    foreach ($questByTheme[$id] as $idTheme) {
                        $domainNotes[$idTheme][] = $note;
                    }
                }
            }

            return $domainNotes;
        }
    }
}
