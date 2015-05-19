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
namespace Diglin\Intrum\CreditDecision\Request\Customer;

use Diglin\Intrum\CreditDecision\Request\ADomElement;

/**
 * Class ExtraInfo
 * @package Diglin\Intrum\Request\Customer
 */
class ExtraInfoType extends ADomElement
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
