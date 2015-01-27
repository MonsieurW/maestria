<?php
namespace Application\Model {

    class Answer
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
/*
CREATE TABLE IF NOT EXISTS answer (
    idAnswer        INTEGER,
    refUser         INTEGER,
    refQuestion     INTEGER,
    notation        VARCHAR(5),

    PRIMARY KEY (idAnswer)
);
*/
        public function value($user, $evaluation, $value)
        {
            if ($this->exists($user, $evaluation) === false) {
                $this
                    ->sql('INSERT INTO answer VALUES(null, :u, :e, :n)', array(
                        'u' => $user,
                        'e' => $evaluation,
                        'n' => json_encode($value)
                        ));

                return $this->_layer->lastInsertId();
            } else {
                $this->update($user, $evaluation, $value);

                return $this->getID($user, $evaluation);
            }
        }

        public function all()
        {
            return $this->sql('SELECT * FROM answer')->fetchAll();
        }

        public function getEvaluation($evaluation)
        {
            return $this->sql('SELECT * FROM answer AS a, user AS u WHERE u.idProfil = a.refUser AND a.refEvaluation = :e', array('e' => $evaluation))->fetchAll();
        }

        public function getStudentEvaluation($id)
        {
            return $this->sql('SELECT * FROM answer as a, evaluation as e WHERE e.idEvaluation =  a.refEvaluation AND a.refUser = :id', array('id' => $id))->fetchAll();
        }

        public function destroy($id)
        {
            $this->sql('DELETE FROM answer WHERE idAnswer = :i', array('i' => $id));
        }

        public function exists($user, $evaluation)
        {
            $sql = 'SELECT COUNT(*) FROM answer WHERE refUser = :user AND refEvaluation = :evaluation';
            $smt = $this->sql($sql, array('user' => $user, 'evaluation' => $evaluation))->fetchColumn(0);

            return (intval($smt) > 0);
        }

        public function update($user, $evaluation, $value)
        {
            $this->sql('UPDATE answer SET note = :v WHERE refUser = :u AND refEvaluation = :e', array('v' => json_encode($value), 'u' => $user, 'e' => $evaluation));
        }

        public function getID($user, $evaluation)
        {
            $sql = 'SELECT * FROM answer WHERE refEvaluation = :e AND refUser = :u';
            $sql = $this->sql($sql, array('e' => $evaluation, 'u' => $user))->fetchAll();

            if(count($sql) === 1)

                return $sql[0]['idAnswer'];

            return null;
        }

    }
}
