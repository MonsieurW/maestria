<?php
namespace Application\Model {

    class User
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

        public function exists($id)
        {
            return true; // TODO : : Check
        
        }

        public function check($login, $password)
        {
            $sqt = $this->sql('SELECT * FROM user WHERE login = :login AND password = :password ', array(
                'login' => $login,
                'password' => sha1($password)
            ))->fetchAll();   

            return !empty($sqt);
        }

        public function checkWithId($id, $password)
        {
            $sqt = $this->sql('SELECT * FROM user WHERE idProfil = :id AND password = :password ', array(
                'id' => $id,
                'password' => sha1($password)
            ))->fetchAll();   

            return !empty($sqt);
        }

        public function getByUser($user) 
        {
            $st             = $this->sql('SELECT * FROM user WHERE login = :id' , array('id' => $user))->fetchAll();
            $item           = $st[0];
            $item['class']  = explode('|', $item['class']); // TODO : Update API 
            $item['domain'] = explode('|', $item['domain']); // TODO : Update API 

            return $item;
        }

        public function add($login, $password, $user, $class, $domain)
        {
            $class  = str_replace(',', '|', $class); // TODO : Update API 
            $domain = str_replace(',', '|', $domain); // TODO : Update API 

            $sql = "INSERT INTO user VAlUES (null,:l,'0','0','0',:p, :n);";
            $this->sql($sql, array(
                'l' => $login,
                'p' => sha1($password),
                'n' => $user
            ));

            // TODO : Insert in insert
        }

        public function updatePassword($id, $password)
        {
            $this->update($id, 'password', sha1($password));
        }

        public function update($id, $col, $value)
        {
            if($value === null)
                return;
            
            $this->sql('UPDATE user set '.$col.' = :p WHERE idProfil = :i' , array('p' => $value,'i' => $id));
        }

        public function get($id)
        {
            $class          = new \Application\Model\UserClass();
            $domain         = new \Application\Model\UserDomain();
            $st             = $this->sql('SELECT * FROM user WHERE idProfil = :id' , array('id' => $id))->fetchAll();
            $item           = $st[0];
            $item['class']  = $class->getClass($id);
            $item['domain'] = $domain->getDomain($id);

            return $item;
        }

        public function all()
        {
            $class   = new \Application\Model\UserClass();
            $domain  = new \Application\Model\UserDomain();
            $st      = $this->sql('SELECT * FROM user')->fetchAll();

            foreach ($st as $i => $value) {
                $st[$i]['class']    = $class->getClass($value['idProfil']);
                $st[$i]['domain']   = $domain->getDomain($value['idProfil']);
            }

            return $st;
        }

        public function count()
        {
            // TODO :: Do it
        }
    }
}
