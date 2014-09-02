<?php
namespace Application\Model {

    class Theme
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

        public function add($value)
        {
            $value = strtolower($value);
            if ($this->exists($value) === false) {
                $this->sql('INSERT INTO theme VALUES(null, :v);' , array('v' => $value));

               return $this->_layer->lastInsertId();
            }
        }

        public function destroy($id)
        {
            $this->sql('DELETE FROM theme WHERE idTheme = :i' , array('i' => $id));
        }

        public function exists($value)
        {
            $sql = 'SELECT COUNT(*) FROM theme WHERE themeValue = :id';
            $smt = $this->sql($sql, array('id' => $value))->fetchColumn(0);

            return (intval($smt) > 0);
        }

        public function update($id, $value)
        {
            $value = strtolower($value);

            $this->sql('UPDATE theme SET themeValue = :v WHERE idTheme = :i', array('v' => $value, 'i' => $id));
        }

        public function getID($value)
        {
            $value = strtolower($value);
            $sql = 'SELECT * FROM theme WHERE themeValue = :v';
            $sql = $this->sql($sql, array('v' => $value))->fetchAll();

            if(count($sql) === 1)

                return $sql[0]['idTheme'];

            return null;
        }

        public function get($id)
        {
            $value = strtolower($id);
            $sql = 'SELECT * FROM theme WHERE idTheme = :v';
            $sql = $this->sql($sql, array('v' => $value))->fetchAll();

            if(count($sql) === 1)

                return $sql[0];

            return null;
        }

        public function all()
        {
           $sql = 'SELECT * FROM theme';

           return $this->sql($sql)->fetchAll();
        }
    }
}
