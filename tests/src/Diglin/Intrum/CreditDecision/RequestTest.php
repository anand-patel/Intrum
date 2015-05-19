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

/**
 * Class RequestTest
 * @package Diglin\Intrum\CreditDecision
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $config;

    protected $data  = array();

    protected function setUp()
    {
        $this->config = new \StdClass();
        $this->config->clientId = '123456';
        $this->config->requestId = '12345';
        $this->config->userID = '12434567';
        $this->config->email = 'support@diglin.com';
        $this->config->password = 'mypass';

        $this->data = array(
            'customer_reference' => 'my reference',
            'person' => array(
                'first_name' => 'Sylvain',
                'last_name' => 'Rayé',
                'gender' => 1,
                'date_of_birth' => '', // DD.MM.YYYY
                'current_address' => array(
                    'first_line' => 'Rütistasse',
                    'house_number' => '14',
                    'post_code' => '8952',
                    'country_code' => 'CH',
                    'town' => 'Schlieren',
                ),
                'communication_numbers' => array(
                    'mobile' => '0786956643',
                    'email' => 'support@diglin.com'
                ),
                'extra_info' => array(
                    array(
                        'name' => 'ORDERCLOSED',
                        'value' => 'NO'
                    ),
                    array(
                        'name' => 'ORDERAMOUNT',
                        'value' => '100'
                    ),
                    array(
                        'name' => 'ORDERCURRENCY',
                        'value' => 'CHF'
                    )
                )
            )
        );

        parent::setUp();
    }

    public function testCreateXmlDocument()
    {
        $dom = new \DOMDocument("1.0", "UTF-8");

        /* @var $request Request */
        $request = $dom->appendChild(new Request());

        $request->setClientId($this->config->clientId);
        $request->setUserID($this->config->userID);
        $request->setPassword($this->config->password);
        $request->setEmail($this->config->email);
        $request->setRequestId($this->config->requestId);

        $request->createRequest($this->data);

        print $dom->saveXML();

        libxml_use_internal_errors(false);
        $this->assertTrue($dom->schemaValidate($request->getNoNamespaceSchemaLocation()), 'DOM Document not validate');
    }
}