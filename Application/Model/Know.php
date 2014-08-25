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

        public function update($id, $value)
        {
            
        }

        public function all()
        {
            return $this->sql('SELECT * FROM connaissance')->fetchAll();
        }
    }
}
