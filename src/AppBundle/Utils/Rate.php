<?php
namespace AppBundle\Utils;

class Rate{

    private $_type,$_value,$_source;

    /**
     * Rate constructor.
     * @param $_type
     * @param $_value
     * @param $_source
     */
    public function __construct($_type, $_value, $_source)
    {
        $this->_type = $_type;
        $this->_value = $_value;
        $this->_source = $_source;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->_source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->_source = $source;
    }


    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }


    
}