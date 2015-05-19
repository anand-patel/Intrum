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
 * Class Person
 * @package Diglin\Intrum\Request\Customer
 */
class Person extends ADomElement
{
    /**
     * @var string
     */
    protected $elementName = 'Person';

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var int
     */
    protected $gender;

    /**
     * @var string
     */
    protected $dateOfBirth;

    /**
     * @var int
     */
    protected $maritalStatus;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string Country code ISO2 or ISO3
     */
    protected $nationality;

    /**
     * @var string
     */
    protected $residentPermit;

    /**
     * @var string Date
     */
    protected $residentSince;

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
     * @var array ExtraInfo
     */
    protected $extraInfo;

    /**
     * Get Last Name
     *
     * @return string
     */
    public function getLastName()
    {
        return mb_substr($this->lastName, 0, 35);
    }

    /**
     * Set Last Name
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get First Name
     *
     * @return string
     */
    public function getFirstName()
    {
        return mb_substr($this->firstName, 0, 35);
    }

    /**
     * Set First Name
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get Gender - 1: male - 2: female
     *
     * @return int
     */
    public function getGender()
    {
        return (!empty($this->gender)) ? (int)$this->gender : null;
    }

    /**
     * Set Gender
     *
     * @param int $gender
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get Date of birth
     *
     * @return string
     */
    public function getDateOfBirth()
    {
        return (isset($this->dateOfBirth)) ? (string)$this->dateOfBirth : null;
    }

    /**
     * Set Date of birth
     *
     * @param string $dateOfBirth
     * @return $this
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get Marital Status
     *
     * @return int
     */
    public function getMaritalStatus()
    {
        return (!empty($this->maritalStatus)) ? (int)$this->maritalStatus : '';
    }

    /**
     * Set Marital Status
     *
     * @param int $maritalStatus
     * @return $this
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get Language
     *
     * @return string
     */
    public function getLanguage()
    {
        return mb_substr($this->language, 0, 2);
    }

    /**
     * Set Language
     *
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get Nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return mb_substr($this->nationality, 0, 3);
    }

    /**
     * Set Nationality
     *
     * @param string $nationality
     * @return $this
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get Resident Permit
     *
     * @return string
     */
    public function getResidentPermit()
    {
        return $this->residentPermit;
    }

    /**
     * Set Resident Permit
     *
     * @param string $residentPermit
     * @return $this
     */
    public function setResidentPermit($residentPermit)
    {
        $this->residentPermit = $residentPermit;

        return $this;
    }

    /**
     * Get Resident Since
     *
     * @return string
     */
    public function getResidentSince()
    {
        return $this->residentSince;
    }

    /**
     * Set Resident Since
     *
     * @param string $residentSince
     * @return $this
     */
    public function setResidentSince($residentSince)
    {
        $this->residentSince = $residentSince;

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
     * Get Communication Numbers
     *
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
