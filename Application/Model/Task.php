<?php
namespace Application\Model {

    class Task
    {
        private $_layer = null;
        private $_prof  = null;

        public function __construct($professor_id)
        {

            //$this->_layer = \Hoa\Database\Dal::getLastInstance();
            
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
