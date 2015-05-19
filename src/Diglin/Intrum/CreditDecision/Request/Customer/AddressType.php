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
 * Class AddressType
 * @package Diglin\Intrum\Request\Customer
 */
class AddressType extends ADomElement
{
    /**
     * @var string
     */
    protected $elementName = 'Address';

    /**
     * @var string
     */
    protected $firstLine;

    /**
     * @var string
     */
    protected $houseNumber;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $postCode;

    /**
     * @var string
     */
    protected $town;

    /**
     * Get First Line
     * 
     * @return string
     */
    public function getFirstLine()
    {
        return mb_substr($this->firstLine, 0, 50);
    }

    /**
     * Set First Line
     *
     * @param string $firstLine
     * @return $this
     */
    public function setFirstLine($firstLine)
    {
        $this->firstLine = $firstLine;
        return $this;
    }

    /**
     * Get House Number
     *
     * @return string
     */
    public function getHouseNumber()
    {
        return mb_substr($this->houseNumber, 0, 35);
    }

    /**
     * Set House Number
     *
     * @param string $houseNumber
     * @return $this
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;
        return $this;
    }

    /**
     * Get Country Code
     *
     * @return string
     */
    public function getCountryCode()
    {
        return mb_substr($this->countryCode, 0, 3);
    }

    /**
     * Set Country Code
     *
     * @param string $countryCode
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * Get Post Code
     *
     * @return string
     */
    public function getPostCode()
    {
        return mb_substr($this->postCode, 0, 8);
    }

    /**
     * Set Post Code
     *
     * @param string $postCode
     * @return $this
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
        return $this;
    }

    /**
     * Get Town
     *
     * @return string
     */
    public function getTown()
    {
        return mb_substr($this->town, 0, 50);
    }

    /**
     * Set Town
     *
     * @param string $town
     * @return $this
     */
    public function setTown($town)
    {
        $this->town = $town;
        return $this;
    }
}
