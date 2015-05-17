<?php
/**
 * Diglin GmbH - Switzerland
 *
 * This file is part of a Diglin_Intrum module.
 *
 * This Diglin GmbH module is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 3 as
 * published by the Free Software Foundation.
 *
 * This script is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     Diglin_Intrum
 * @copyright   Copyright (c) 2011-2015 Diglin (http://www.diglin.com)
 * @license     http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 */
namespace Diglin\Intrum\CreditDecision\Request;

/**
 * Class ADomElement
 * @package Diglin\Intrum\Request
 */
class ADomElement extends \DOMElement implements \ArrayAccess
{
    /**
     * @var string
     */
    protected $elementName;

    /**
     * @var array
     */
    private $_data;

    /**
     * @var array
     */
    protected $requiredProperties = array();

    /**
     * @var array
     */
    protected $optionalProperties = array();

    /**
     * @param null|string $name
     * @param null|string $value
     * @param null|string $uri
     */
    public function __construct($name = null, $value = null, $uri = null)
    {
        if (is_null($name)) {
            $name = $this->elementName;
        }
        parent::__construct($name, $value, $uri);
    }

    /**
     * @return array
     */
    public function getRequiredProperties()
    {
        return (array) $this->requiredProperties;
    }

    /**
     * @return array
     */
    public function getOptionalProperties()
    {
        return (array) $this->optionalProperties;
    }

    public function appendDataProperties(array $data = null, ADomElement $object = null)
    {
        if (is_null($object)) {
            $object = $this;
        }

        if (!is_null($data)) {
            foreach ($data as $key => $value) {
                $getValue = null;
                $method = $this->_getSetterMethod($key);
                if (is_callable(array($object, $method))) {
                    $object->$method($value);
                }
            }

            $data = $object->getDataProperties();
            foreach ($data as $key => $value) {
                if (is_null($value) || $value == '') {
                    continue;
                }

                if (is_array($value)) {
                    foreach ($value as $node) {
                        $classname = 'Diglin\Intrum\CreditDecision\Request\Customer\\' . $node['type'];
                        if (class_exists($classname)) {
                            /* @var $node ADomElement */
                            $child = $this->appendChild(new $classname($this->_normalizeProperty($node['name'])));
                            $child->appendDataProperties($node['data'], $child);
                        }

                    }
                } else if (!$value instanceof \DOMElement) {
                    $this->appendChild(new \DOMElement($key, $value));
                } else {
                    $this->appendChild($value);
                }
            }
        }

        return $this;
    }

    /**
     * Get all properties of a class as an array to be send or use properly by the API
     *
     * @return array
     */
    public function getDataProperties()
    {
        $data = array();
        $reflect = new \ReflectionObject($this);

        foreach ($reflect->getProperties(\ReflectionProperty::IS_PROTECTED) as $property) {

            $skipProperties = array('requiredProperties', 'optionalProperties', 'elementName');
            if (in_array($property->getName(), $skipProperties)) {
                continue;
            }

            $method = $this->_getGetterMethod($property->getName());

            $value = null;
            if (is_callable(array($this, $method))) {
                $value = $this->$method();
            }

            if ($value instanceof ADomElement) {
                $value = $value->getDataProperties();
            }

            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    if ($item instanceof ADomElement) {
                        $value[$key] = $item->getDataProperties();
                    }
                }
            }

            // skip empty value for properties which are optional
            if (is_null($value) && in_array(substr($property->getName(), 1, strlen($property->getName())), $this->optionalProperties)) {
                continue;
            }

            $data[$this->_normalizeProperty($property->getName())] = $value;
        }

        return $data;
    }

    /**
     * Normalize the property from "_myProperty" to "MyProperty"
     *
     * @param $name
     * @return string
     */
    protected function _normalizeProperty($name)
    {
        if (strpos($name, '_') === 0) {
            $name = substr($name, 1, strlen($name));
        }

        $result = explode('_', $name);
        foreach ($result as $key => $value) {
            $result[$key] = ucwords($value);
        }

        $name = implode('', $result);

        return ucwords($name);
    }

    /**
     * Get the getter method name
     *
     * @param $name
     * @return string
     */
    protected function _getGetterMethod($name)
    {
        return 'get' . $this->_normalizeProperty($name);
    }

    /**
     * Get the setter method name
     *
     * @param $name
     * @return string
     */
    protected function _getSetterMethod($name)
    {
        return 'set' . $this->_normalizeProperty($name);
    }

    /**
     * Implementation of ArrayAccess::offsetSet()
     *
     * @link http://www.php.net/manual/en/arrayaccess.offsetset.php
     * @param string $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $method = $this->_getSetterMethod($offset);
        if (is_callable(array($this, $method))) {
            $this->$method($value);
        } else {
            $this->_data[$offset] = $value;
        }
    }

    /**
     * Implementation of ArrayAccess::offsetExists()
     *
     * @link http://www.php.net/manual/en/arrayaccess.offsetexists.php
     * @param string $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        $method = $this->_getGetterMethod($offset);
        if (is_callable(array($this, $method))) {
            return (bool) $this->$method();
        } else {
            return isset($this->_data[$offset]);
        }
    }

    /**
     * Implementation of ArrayAccess::offsetUnset()
     *
     * @link http://www.php.net/manual/en/arrayaccess.offsetunset.php
     * @param string $offset
     */
    public function offsetUnset($offset)
    {
        $method = $this->_getSetterMethod($offset);
        if (is_callable(array($this, $method))) {
            $this->$method(null);
        } else {
            unset($this->_data[$offset]);
        }
    }

    /**
     * Implementation of ArrayAccess::offsetGet()
     *
     * @link http://www.php.net/manual/en/arrayaccess.offsetget.php
     * @param string $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $method = $this->_getGetterMethod($offset);
        if (is_callable(array($this, $method))) {
            return $this->$method();
        } else {
            return isset($this->_data[$offset]) ? $this->_data[$offset] : null;
        }
    }
}
