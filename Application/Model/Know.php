<?php
namespace Application\Model {

    class Know
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

        public function add($domain, $theme, $type, $lvl, $item)
        {
            $lvl = intval($lvl);
            $this->sql('INSERT INTO connaissance VALUES(null, :d, :t, :type, :lvl, :item);', array(
                'd' => $domain,
                't' => $theme,
                'type' => $type,
                'lvl' => $lvl,
                'item' => $item
                ));
        }

        public function exists($value)
        {
            return false;
        }

        public function update($id, $col, $value)
        {
            var_dump($value, $col, $id);
            $sql = 'UPDATE connaissance SET '.$col.' = :d WHERE idConnaissance = :i';
            $this->sql($sql, array('d' => $value, 'i'=> $id));
            
        }

        public function destroy($id)
        {
            $this->sql('DELETE FROM connaissance WHERE idConnaissance = :i', array('i' => $id));
        }

        public function all()
        {
            return $this->sql('SELECT * FROM connaissance ORDER BY refDomain')->fetchAll();
        }
    }
}
