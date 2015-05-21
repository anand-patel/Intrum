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
 * Class Company
 * @package Diglin\Intrum\Request\Customer
 */
class Company extends ADomElement
{
    protected $elementName = 'Company';

    /**
     * @var string
     */
    protected $companyName1;

    /**
     * @var string
     */
    protected $companyName2;

    /**
     * @var Address
     */
    protected $currentAddress;

    /**
     * @var Address
     */
    protected $previousAddress;

    /**
     * @var CommunicationNumbers
     */
    protected $communicationNumbers;

    /**
     * @var array
     */
    protected $orderingPerson;

    /**
     * @var array ExtraInfo
     */
    protected $extraInfo;

    /**
     * @return string
     */
    public function getCompanyName1()
    {
        return mb_substr($this->companyName1, 0, 60);
    }

    /**
     * @param string $companyName1
     * @return $this
     */
    public function setCompanyName1($companyName1)
    {
        $this->companyName1 = $companyName1;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompanyName2()
    {
        return mb_substr($this->companyName2, 0, 35);
    }

    /**
     * @param string $companyName2
     * @return $this
     */
    public function setCompanyName2($companyName2)
    {
        $this->companyName2 = $companyName2;

        return $this;
    }

    /**
     * Get Current Address
     *
     * @return Address
     */
    public function getCurrentAddress()
    {
        return $this->currentAddress;
    }

    /**
     * Set Current Address
     *
     * @param array $currentAddress
     * @return $this
     */
    public function setCurrentAddress(array $currentAddress)
    {
        $this->currentAddress = new Address('CurrentAddress');
        $this->currentAddress->addData($currentAddress);

        return $this;
    }

    /**
     * Get Previous Address
     *
     * @return Address
     */
    public function getPreviousAddress()
    {
        return $this->previousAddress;
    }

    /**
     * Set Previous Address
     *
     * @param array $previousAddress
     * @return $this
     */
    public function setPreviousAddress(array $previousAddress)
    {
        $this->previousAddress = new Address('PreviousAddress');
        $this->previousAddress->addData($previousAddress);

        return $this;
    }

    /**
     * @return CommunicationNumbers
     */
    public function getCommunicationNumbers()
    {
        return $this->communicationNumbers;
    }

    /**
     * Set Communication Numbers
     *
     * @param array $communicationNumbers
     * @return $this
     */
    public function setCommunicationNumbers(array $communicationNumbers)
    {
        $this->communicationNumbers = new CommunicationNumbers('CommunicationNumbers');
        $this->communicationNumbers->addData($communicationNumbers);

        return $this;
    }

    /**
     * @return Person
     */
    public function getOrderingPerson()
    {
        return $this->orderingPerson;
    }

    /**
     * @param array $orderingPerson
     * @return $this
     */
    public function setOrderingPerson(array $orderingPerson)
    {
        $person = new Person('Person');
        $person->addData($orderingPerson['person']);

        $this->orderingPerson['OrderingPerson']['Person'] = $person;
        $this->orderingPerson['OrderingPerson']['Function'] = $orderingPerson['function'];

        return $this;
    }

    /**
     * Get Extra Info
     *
     * @return array
     */
    public function getExtraInfo()
    {
        return $this->extraInfo;
    }

    /**
     * Set Extra Info
     *
     * $extraInfo = array(
     *      array('name' => '', 'value' => '')
     * )
     *
     * @param  array $extraInfo Extra Info
     * @param  bool $clear Clear
     * @return $this
     * @throws \Exception
     */
    public function setExtraInfo(array $extraInfo, $clear = false)
    {
        if ($clear == true) {
            $this->extraInfo = array();
        }

        $ExtraInfo = null;
        foreach ($extraInfo as $info) {
            if (empty($info["name"]) || !isset($info["value"])) {
                throw new \Exception("ExtraInfo requires 'name' and 'value' keys");
            }

            $infoType = new ExtraInfo();
            $infoType->addData($info);
            $this->extraInfo[] = $infoType;
        }

        return $this;
    }
}