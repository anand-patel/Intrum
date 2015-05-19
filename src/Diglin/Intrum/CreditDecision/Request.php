<?php
/**
 * Diglin GmbH - Switzerland
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     Diglin_Intrum
 * @copyright   Copyright (c) 2011-2015 Diglin (http://www.diglin.com)
 */
namespace Diglin\Intrum\CreditDecision;

use Diglin\Intrum\CreditDecision\Request\ADomElement;
use Diglin\Intrum\CreditDecision\Request\Customer;

/**
 * Class Request
 * @package Diglin\Intrum
 */
class Request extends ADomElement
{
    /**
     * @var string
     */
    protected $elementName = 'Request';

    /**
     * @var Customer
     */
    private $customer;

    /**
     * @var string
     */
    private $version = '1.00';

    /**
     * @var string
     */
    private $xmlnsXsi = 'http://www.w3.org/2001/XMLSchema-instance';

    /**
     * @var string
     */
    private $noNamespaceSchemaLocation = 'http://site.intrum.ch/schema/CreditDecisionRequest140.xsd';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $requestId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $userID;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $siteId;

    /**
     * @var string
     */
    private $siteSubId;

    /**
     * @param array $data
     * @return $this
     * @throws \Exception
     */
    public function createRequest(array $data)
    {
        $this->initAttributes();
        $this->appendCustomer($data);

        return $this;
    }

    /**
     * Set the Request Attributes
     *
     * @return $this
     */
    public function initAttributes()
    {
//        $this->setAttribute("xmlns:xsi", (string) $this->xmlnsXsi);
//        $this->setAttribute("xsi:noNamespaceSchemaLocation", (string) $this->noNamespaceSchemaLocation);
        $this->setAttribute("Version",   (float) $this->version);

        return $this;
    }

    /**
     * Append Customer to Request
     *
     * @param array $data
     * @return Customer|\DOMNode
     * @throws \Exception
     */
    public function appendCustomer(array $data)
    {
        if (!isset($data['customer_reference'])) {
            throw new \Exception ('customer_reference data is required');
        }

        $this->getCustomer()->setReference($data['customer_reference']);

        if (isset($data['person'])) {
            $this->getCustomer()->appendPerson($data['person']);
        }

        if (isset($data['company'])) {
            $this->getCustomer()->appendCompany($data['company']);
        }

        return $this->getCustomer();
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        if (!$this->customer instanceof Customer) {
            $this->customer = $this->appendChild(new Customer());
        }
        return $this->customer;
    }

    /**
     * @param Customer $customer
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return string
     */
    public function getNoNamespaceSchemaLocation()
    {
        return $this->noNamespaceSchemaLocation;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->setAttribute("Password", $password);
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->setAttribute("ClientId", $clientId);
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     * @return $this
     */
    public function setRequestId($requestId)
    {
        $this->setAttribute("RequestId", $requestId);
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     * @throws \Exception
     */
    public function setEmail($email)
    {
        if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) {
            throw new \Exception("Request Email is invalid");
        }

        $this->setAttribute("Email", $email);
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param string $userID
     * @return $this
     */
    public function setUserID($userID)
    {
        $this->setAttribute("UserID", $userID);
        $this->userID = $userID;

        return $this;
    }

    /**
     * @return string
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * @param string $siteId
     * @return $this
     */
    public function setSiteId($siteId)
    {
        $this->setAttribute("SiteId", $siteId);
        $this->siteId = $siteId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSiteSubId()
    {
        return ($this->siteSubId) ? $this->siteSubId : null;
    }

    /**
     * @param string $siteSubId
     * @return $this
     */
    public function setSiteSubId($siteSubId)
    {
        $this->setAttribute("SiteSubId", $siteSubId);
        $this->siteSubId = $siteSubId;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->setAttribute("Version", $version);
        $this->version = $version;

        return $this;
    }
}
