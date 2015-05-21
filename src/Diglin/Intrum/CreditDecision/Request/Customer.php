<?php
/**
 * Diglin GmbH - Switzerland
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     Diglin_Intrum
 * @copyright   Copyright (c) 2011-2015 Diglin (http://www.diglin.com)
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
     * @return Company|\DOMNode
     */
    public function appendCompany($data)
    {
        $this->company = $this->appendChild(new Company());
        $this->company->appendDataProperties($data);

        return $this->company;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param Person $person
     * @return $this
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }
}
