<?php

namespace Camael\Api\Tests\Unit\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserters;

class Node extends asserters\variable implements \arrayAccess
{

    protected $_errors = [];
    protected $_xpath  = null;

    public function setWith($request)
    {
        if($request instanceof \DOMNodeList)
            $value = $request;
        else
            return $this->fail('Node need DOMNodeList instance');

        parent::setWith($value);
    }

    public function offsetGet($key)
    {
        return $this->getValue()->item($key);
    }

    public function offsetSet($key, $value)
    {
        throw new exceptions\logic('Tested node is read only');
    }

    public function offsetUnset($key)
    {
        throw new exceptions\logic('Node is read only');
    }

    public function offsetExists($key)
    {
        return ($this->getValue()->item($key) !== null);
    }
}
