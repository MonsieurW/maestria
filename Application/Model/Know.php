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

        protected function getMax($domain, $theme)
        {
            $sql  = 'SELECT MAX(lvl) AS max FROM connaissance WHERE refTheme = :t AND refDomain = :d;';
            $data = $this->sql($sql, ['t' => $theme, 'd' => $domain])->fetchAll();
            $max  = intval($data[0]['max']);

            return $max;
        }

        public function add($domain, $theme, $item)
        {
            $lvl = $this->getMax($domain, $theme);

            $this->sql('INSERT INTO connaissance VALUES(null, :d, :t, :lvl, :item);', array(
                'd' => $domain,
                't' => $theme,
                'lvl' => ($lvl +1),
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
            if($col == 'lvl')
                throw new Exception("Error API VERSION", 0);
                
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

        public function getTheme($id)
        {
            $item = $this->get($id);
            $elmt = '';

            if (!empty($item) and isset($item[0])) {
                $elmt = $item[0]['refTheme'];
            }

            return $elmt;
        }

        public function getDomain($id)
        {
            $item = $this->get($id);
            $elmt = '';

            if (!empty($item) and isset($item[0])) {
                $elmt = $item[0]['refDomain'];
            }

            return $elmt;
        }

        public function getThemeItem($id)
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
            return $this->sql('SELECT * FROM connaissance ORDER BY refDomain, refTheme, lvl LIMIT :l, :n', array('l' => $start, 'n' => $nb))->fetchAll();
        }

        public function getAll()
        {
            return $this->sql('SELECT * FROM connaissance ORDER BY refDomain, refTheme, lvl')->fetchAll();
        }

        public function count()
        {
            $sql = 'SELECT COUNT(*) FROM connaissance';
            $smt = $this->sql($sql)->fetchColumn(0);

            return intval($smt);
        }
    }
}
