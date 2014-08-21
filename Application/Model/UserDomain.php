<?php
namespace Application\Model {

    class UserDomain
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

        public function associate($idUser, $idDomain)
        {
        	if($this->exists($idUser, $idDomain) === false)
            {
                $sql = 'INSERT INTO user_domain VALUES(null, :u, :d);';

                $this->sql($sql, array('u' => $idUser, 'd' => $idDomain));
            }

        }

        public function exists($idUser, $idDomain)
        {
        	return false;  // TODO : Make it
        }

        public function getDomain($idUser)
        {
        	$sql = 'SELECT * FROM user_domain as uc, domain as c WHERE uc.refDomain = c.idDomain AND uc.refUser = :i';
        	$sql = $this->sql($sql, array('i' => $idUser))->fetchAll();
        	$a   = array();

        	foreach ($sql as $key => $value) {
        		$a[] = $value['value'];
        	}

        	return $a;
        }

        public function remove($idUser, $idDomain)
        {
            $this->sql('DELETE FROM user_domain WHERE refUser = :i AND refDomain = :c', array('i' => $idUser, 'c' => $idDomain));
        }

        public function sync($id, $values)
        {
            if(empty($values))
                return;

            $class  = new \Application\Model\Domain();
            $actual = $this->getDomain($id);
            $delete = array_diff($actual, $values);
            $new    = array_diff($values, $actual);

            foreach ($delete as $value) {
                $value    = trim($value);
                $idDomain = $class->getID($value);
                $this->remove($id, $idDomain);
            }

            foreach ($new as $value) {
                $value  = trim($value);
                $get    = $class->getID($value);
                if($get === null){
                    $class->add($value);
                    $get = $class->getID($value);
                }

                $this->associate($id, $get);
            }
        }


    }
}
