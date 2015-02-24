<?php
namespace Application\Maestria {

    class Maestria extends \Sohoa\Framework\Framework
    {
        protected $_acl;
        public $_router;

        public function setAcl()
        {
            $this->_acl = new Acl($this);

            $this->_acl
                ->allow('app.(.*)', array('student', 'professor', 'moderator', 'admin'))
                //->deny('app.evaluation.edit', array('student', 'professor', 'moderator', 'admin'))
            ; //TODO : Make it :D
        }

        public function getAcl()
        {
            return $this->_acl;
        }
    }
}
