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
            return true;
        
        }

        public function check($login, $password)
        {
            $sqt = $this->sql('SELECT * FROM user WHERE login = :login AND password = :password ', array(
                'login' => $login,
                'password' => sha1($password)
            ))->fetchAll();   

            return !empty($sqt);
        }

        public function add($login, $password, $user, $class, $domain)
        {
            $class  = str_replace(',', '|', $class);
            $domain = str_replace(',', '|', $domain);

            $sql = "INSERT INTO user VAlUES (null,:l,'0','0','0',:p, :n, :c, :d);";
            $this->sql($sql, array(
                'l' => $login,
                'p' => sha1($password),
                'n' => $user,
                'c' => $class,
                'd' => $domain
            ));

            
        }

        public function get($id)
        {
            $st             = $this->sql('SELECT * FROM user WHERE idProfil = :id' , array('id' => $id))->fetchAll();
            $item           = $st[0];
            $item['class']  = explode('|', $item['class']);
            $item['domain'] = explode('|', $item['domain']);

            return $item;
        }

        public function all()
        {
            $st = $this->sql('SELECT * FROM user')->fetchAll();

            foreach ($st as $i => $value) {
                $st[$i]['class']    = explode('|', $value['class']);    
                $st[$i]['domain']   = explode('|', $value['domain']);
            }

            return $st;
        }

        public function count()
        {
        
        }
    }
}
