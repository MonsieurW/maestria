<?php
namespace Application\Maestria {

    class Greut extends \Sohoa\Framework\View\Greut
    {
        public function reset()
        {
            $this->_blocks =  [];
            $this->_blocknames = [];
            $this->_headers = [];
            $this->_file = '';
        }
    }
}
