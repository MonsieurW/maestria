<?php
namespace Camael\Api\Tests\Unit\Mock;

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