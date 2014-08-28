<?php
namespace Application\Model {

    class UserClass
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

        public function associate($idUser, $idClass)
        {
            if ($this->exists($idUser, $idClass) === false) {
                $sql = 'INSERT INTO user_class VALUES(null, :u, :c);';

                $this->sql($sql, array('u' => $idUser, 'c' => $idClass));

               return $this->_layer->lastInsertId();
            }

        }

        public function exists($idUser, $idClass)
        {
            $sql = 'SELECT COUNT(*) FROM user_class WHERE refUser = :u AND refClass = :c';
            $smt = $this->sql($sql, array('u' => $idUser, 'c' => $idClass))->fetchColumn(0);

            return (intval($smt) > 0);
        }

        public function getClass($idUser)
        {
            $sql = 'SELECT * FROM user_class as uc, class as c WHERE uc.refClass = c.idClass AND uc.refUser = :i';
            $sql = $this->sql($sql, array('i' => $idUser))->fetchAll();
            $a   = array();

            foreach ($sql as $key => $value) {
                $a[] = $value['value'];
            }

            return $a;
        }

        public function getUsers($idClass)
        {
            $sql = 'SELECT * FROM user_class as uc, user as u WHERE uc.refUser = u.idProfil AND refClass = :c';

            return $this->sql($sql, array('c' => $idClass))->fetchAll();
        }

        public function getEleves($idClass)
        {
            $sql = 'SELECT * FROM user_class as uc, user as u WHERE uc.refUser = u.idProfil AND u.isAdmin  = 0 AND u.isModerator  = 0 AND u.isProfessor  = 0 AND refClass = :c';

            return $this->sql($sql, array('c' => $idClass))->fetchAll();
        }

        public function remove($idUser, $idClass)
        {
            $this->sql('DELETE FROM user_class WHERE refUser = :i AND refClass = :c', array('i' => $idUser, 'c' => $idClass));
        }

        public function sync($id, $values)
        {

            if(empty($values))

                return;

            $class  = new \Application\Model\Classe();
            $actual = $this->getClass($id);
            $delete = array_diff($actual, $values);
            $new    = array_diff($values, $actual);

            foreach ($delete as $value) {
                $value   = trim($value);
                $idClass = $class->getID($value);
                $this->remove($id, $idClass);
            }

            foreach ($new as $value) {
                $value  = trim($value);
                $get    = $class->getID($value);
                /*if ($get === null) { // HERE for add new value
                    $class->add($value);
                    $get = $class->getID($value);
                }*/

                if($get !== null)
                    $this->associate($id, $get);
            }
        }
    }
}
