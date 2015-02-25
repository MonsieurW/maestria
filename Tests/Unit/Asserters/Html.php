<?php

namespace Camael\Api\Tests\Unit\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserters;

class Html extends asserters\variable
{

    protected $_errors = [];
    protected $_xpath  = null;

    public function setWith($request)
    {
        if($request instanceof Request)
            $value = $request->getValue();
        else
            return $this->fail('Html need an request run before, or be set with an Camael\Api\Tests\Unit\Asserters\Request instance');


        $dom    = new \DOMDocument();

        libxml_use_internal_errors(true);
        $value         = $dom->loadHTML($value);
        $this->_errors = libxml_get_errors();
        
        foreach ($this->_errors as $key => $obj) {
            $arg = [
                $obj->line,
                $obj->column,
                $obj->code,
                $obj->message
            ];
            $this->_errors[$key] = vsprintf('Line: %s, Column: %s, Code: %s, Message: %s', $arg);
        }

        // var_dump($this->_errors);

        libxml_clear_errors();

        parent::setWith($dom);
    }

    public function xquery($query)
    {
        if($this->_xpath === null) {
            $this->_xpath = new \DOMXPath($this->getValue());
        }

        $return = $this->_xpath->query($query);

        if($return === false){
            $this->fail('Query ('.$query.') has an error');
        }
     
        return $this->generator->__call('object', [$return]);   
    }



    public function hasError()
    {
        return  $this->generator->__call('boolean', [(empty($this->_errors) === false)]);
    }

    public function __get($key)
    {
        switch ($key) {
            case 'error':
                return $this->generator->__call('array', [$this->_errors]);
                break;
            default:
                break;
        }

        return parent::__get($key);
    }
}
