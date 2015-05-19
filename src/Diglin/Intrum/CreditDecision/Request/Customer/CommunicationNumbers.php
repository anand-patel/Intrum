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
 * Class CommunicationNumbers
 * @package Diglin\Intrum\Request\Customer
 */
class CommunicationNumbers extends ADomElement
{
    /**
     * @var string
     */
    protected $elementName = 'CommunicationNumbers';

    /**
     * @var string
     */
    protected $telephonePrivate;

    /**
     * @var string
     */
    protected $telephoneOffice;

    /**
     * @var string
     */
    protected $fax;

    /**
     * @var string
     */
    protected $mobile;

    /**
     * @var string
     */
    protected $email;

    /**
     * Get Telephone Private
     *
     * @return string
     */
    public function getTelephonePrivate()
    {
        return mb_substr($this->telephonePrivate, 0, 50);
    }

    /**
     * Set Telephone Private
     *
     * @param string $telephonePrivate
     * @return $this
     */
    public function setTelephonePrivate($telephonePrivate)
    {
        $this->telephonePrivate = $telephonePrivate;
        return $this;
    }

    /**
     * Get Telephone Office
     *
     * @return string
     */
    public function getTelephoneOffice()
    {
        return mb_substr($this->telephoneOffice, 0, 50);
    }

    /**
     * Set Telephone Office
     *
     * @param string $telephoneOffice
     * @return $this
     */
    public function setTelephoneOffice($telephoneOffice)
    {
        $this->telephoneOffice = $telephoneOffice;
        return $this;
    }

    /**
     * Get Fax
     *
     * @return string
     */
    public function getFax()
    {
        return mb_substr($this->fax, 0, 50);
    }

    /**
     * Set Fax
     *
     * @param string $fax
     * @return $this
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * Get Mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return mb_substr($this->mobile, 0, 50);
    }

    /**
     * Set Mobile
     *
     * @param string $mobile
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return mb_substr($this->email, 0, 50);
    }

    /**
     * Get Email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
}
