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

            return $this->_layer->lastInsertId();
        }

        public function exists($value)
        {
            return false;
        }

        public function update($id, $col, $value)
        {
            $sql = 'UPDATE connaissance SET '.$col.' = :d WHERE idConnaissance = :i';
            $this->sql($sql, array('d' => $value, 'i'=> $id));
        }

        public function getWithDomain($id)
        {
            return $this
                        ->sql('SELECT * FROM connaissance AS c, theme AS t WHERE c.refTheme = t.idTheme AND c.refDomain = :r', ['r' => $id])
                        ->fetchAll();
        }

        public function destroy($id)
        {
            $this->sql('DELETE FROM connaissance WHERE idConnaissance = :i', array('i' => $id));
        }

        public function get($id)
        {
            return $this
                        ->sql('SELECT * FROM connaissance WHERE idConnaissance = :i', array('i' => $id))
                        ->fetchAll();
        }

        public function getText($id)
        {
            $item = $this->get($id);
            $elmt = '';

            if (!empty($item) and isset($item[0])) {
                $elmt = $item[0]['item'];
            }

            return $elmt;
        }

        public function all($start, $nb)
        {
            return $this->sql('SELECT * FROM connaissance ORDER BY refDomain LIMIT :l, :n', array('l' => $start, 'n' => $nb))->fetchAll();
        }

        public function getAll()
        {
            return $this->sql('SELECT * FROM connaissance ORDER BY refDomain')->fetchAll();
        }

        public function count()
        {
            $sql = 'SELECT COUNT(*) FROM connaissance';
            $smt = $this->sql($sql)->fetchColumn(0);

            return intval($smt);
        }
    }
}
