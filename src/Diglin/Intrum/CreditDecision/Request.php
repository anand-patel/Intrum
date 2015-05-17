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
     * @var string
     */
    protected $version = '1.00';

    /**
     * @var string
     */
    protected $xmlnsXsi = 'http://www.w3.org/2001/XMLSchema-instance';

    /**
     * @var string
     */
    protected $noNamespaceSchemaLocation = 'http://site.intrum.ch/schema/CreditDecisionRequest131.xsd';

    /**
     * @var string
     */
    protected $validateSchema = 'http://site.intrum.ch/schema/CreditDecisionRequest140.xsd';

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * $config = new StdClass(
     *  'clientId'  => int
     *  'requestId' => int
     *  'email'     => string
     *  'userID'    => int
     *  'password'  => string
     * );
     *
     * @param \stdClass $config
     */
    public function initAttributes(\stdClass $config)
    {
//        $this->setAttribute("xmlns:xsi", $this->xmlnsXsi);
//        $this->setAttribute("xsi:noNamespaceSchemaLocation", $this->noNamespaceSchemaLocation);
        $this->setAttribute("Version",   (float) $this->version);
        $this->setAttribute("ClientId",  (string) $config->clientId);

        $this->setAttribute("RequestId", (string) (isset($config->requestId)) ? $config->requestId : '');
        $this->setAttribute("Email",     (string) (isset($config->email)) ? $config->email : '');
        $this->setAttribute("UserID",    (string) (isset($config->userID)) ? $config->userID : '');
        $this->setAttribute("Password",  (string) (isset($config->password)) ? $config->password : '');
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
        $this->customer = $this->appendChild(new Customer());

        if (!isset($data['customer_reference'])) {
            throw new \Exception ('customer_reference data is required');
        }

        $this->customer->setReference($data['customer_reference']);

        if (isset($data['person'])) {
            $this->customer->appendPerson($data['person']);
        }

        if (isset($data['company'])) {
            $this->customer->appendCompany($data['company']);
        }

        return $this->customer;
    }

    /**
     * @return string
     */
    public function getValidateSchema()
    {
        return $this->validateSchema;
    }
}
