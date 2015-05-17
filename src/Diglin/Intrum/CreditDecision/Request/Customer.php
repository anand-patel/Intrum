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

use Diglin\Intrum\CreditDecision\Request\Customer\Person;
use Diglin\Intrum\CreditDecision\Request\Customer\Company;

/**
 * Class Customer
 * @package Diglin\Intrum\Request
 */
class Customer extends ADomElement
{
    protected $elementName = 'Customer';

    /**
     * @var Person
     */
    protected $person;

    /**
     * @var Company
     */
    protected $company;

    /**
     * Set Reference Attribute
     *
     * @param string $reference Reference
     * @return $this
     */
    public function setReference($reference)
    {
        $this->setAttribute('Reference', $reference);
        return $this;
    }

    /**
     * Append Person to Customer
     *
     * @param $data
     * @return Person|\DOMNode
     */
    public function appendPerson($data)
    {
        $this->person = $this->appendChild(new Person());
        $this->person->appendDataProperties($data);

        return $this->person;
    }

    /**
     * Append Company to Customer
     *
     * @param $data
     * @return Person|\DOMNode
     */
    public function appendCompany($data)
    {
        $this->company = $this->appendChild(new Company());
        $this->company->appendDataProperties($data);

        return $this->company;
    }
}
