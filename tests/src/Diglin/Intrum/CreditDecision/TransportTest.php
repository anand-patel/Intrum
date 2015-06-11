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
 * Class TransportTest
 * @package Diglin\Intrum\CreditDecision
 */
class TransportTest extends \PHPUnit_Framework_TestCase
{
    protected $config;

    protected $data = array();

    protected $dataCompany = array();

    protected function setUp()
    {
        $this->config = new \StdClass();
        $this->config->clientId = '61';
        $this->config->requestId = '12345';
        $this->config->userID = 'ccdach_demo_magento';
        $this->config->email = 'support@diglin.com';
        $this->config->password = 'myMagento77';

        $this->data = array(
            'customer_reference' => 'my reference',
            'person' => array(
                'first_name' => 'Sylvain',
                'last_name' => 'Rayé',
                'gender' => 1,
                'date_of_birth' => '', // DD.MM.YYYY
                'current_address' => array(
                    'first_line' => 'Bremgarterstrasse',
                    'house_number' => '62',
                    'post_code' => '8967',
                    'country_code' => 'CH',
                    'town' => 'Widen',
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
                    ),
                    array(
                        'name' => 'DELIVERY_FIRSTNAME',
                        'value' => 'Sylvain'
                    ),
                    array(
                        'name' => 'DELIVERY_LASTNAME',
                        'value' => 'Rayé'
                    ),
                    array(
                        'name' => 'DELIVERY_FIRSTLINE',
                        'value' => 'Rütistasse 14'
                    ),
//                    array(
//                        'name' => 'DELIVERY_HOUSENUMBER',
//                        'value' => '' // If empty error on API side
//                    ),
                    array(
                        'name' => 'DELIVERY_COUNTRYCODE',
                        'value' => 'CH'
                    ),
                    array(
                        'name' => 'DELIVERY_POSTCODE',
                        'value' => '8952'
                    ),
                    array(
                        'name' => 'DELIVERY_TOWN',
                        'value' => 'Schlieren'
                    )
                )
            )
        );

        $this->dataCompany = array(
            'customer_reference' => 'my reference',
            'company' => array(
                'company_name1' => 'Silverbogen AG',
                'current_address' => array(
                    'first_line' => 'Via Grava 12',
//                    'house_number' => '',
                    'post_code' => '7031',
                    'country_code' => 'CH',
                    'town' => 'Laax',
                ),
                'ordering_person' => array(
                    'function' => 1, // CEO
                    'person' => array(
                        'first_name' => 'Sylvain',
                        'last_name' => 'Rayé',
                        'gender' => 1,
                        'date_of_birth' => '', // DD.MM.YYYY
                        'communication_numbers' => array(
                            'mobile' => '0786956643',
                            'email' => 'support@diglin.com'
                        )
                    )
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

    public function testTransport()
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

        $tranport = new Transport();
        $responseRequest = $tranport->sendRequest($dom);

        $response = new Response();
        $response->setRawResponse($responseRequest);
        $response->processResponse();

        echo $response->getRawResponse();

        $this->assertContains('<Response', $response->getRawResponse(), 'No response found');
        $this->assertEquals(2, $response->getCustomerRequestStatus(), 'Expected Customer Request status is not 2');
    }

    public function testTransportCompany()
    {
        $dom = new \DOMDocument("1.0", "UTF-8");

        /* @var $request Request */
        $request = $dom->appendChild(new Request());

        $request->setClientId($this->config->clientId);
        $request->setUserID($this->config->userID);
        $request->setPassword($this->config->password);
        $request->setEmail($this->config->email);
        $request->setRequestId($this->config->requestId);

        $request->createRequest($this->dataCompany);

        $tranport = new Transport();
        $responseRequest = $tranport->sendRequest($dom);

        $response = new Response();
        $response->setRawResponse($responseRequest);
        $response->processResponse();

//        echo $response->getRawResponse();

        $this->assertContains('<Response', $response->getRawResponse(), 'No response found');
        $this->assertEquals(2, $response->getCustomerRequestStatus(), 'Expected Customer Request status is not 2');
    }
}