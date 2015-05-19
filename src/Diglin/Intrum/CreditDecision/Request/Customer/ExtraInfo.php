<?php
/**
 * Diglin GmbH - Switzerland
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     Diglin_Intrum
 * @copyright   Copyright (c) 2011-2015 Diglin (http://www.diglin.com)
 */
namespace Diglin\Intrum\CreditDecision\Request\Customer;

use Diglin\Intrum\CreditDecision\Request\ADomElement;

/**
 * Class ExtraInfo
 * @package Diglin\Intrum\Request\Customer
 */
class ExtraInfo extends ADomElement
{
    /**
     * @var string
     */
    protected $elementName = 'ExtraInfo';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * Get Name
     *
     * @return mixed
     */
    public function getName()
    {
        return mb_substr($this->name, 0, 30);
    }

    /**
     * Set Name
     *
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get Value
     *
     * @return mixed
     */
    public function getValue()
    {
        return mb_substr($this->value, 0, 35);
    }

    /**
     * Set Value
     *
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
