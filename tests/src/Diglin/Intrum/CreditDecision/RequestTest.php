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

/**
 * Class RequestTest
 * @package Diglin\Intrum\CreditDecision
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    protected $config;

    protected $dataPerson  = array();
    protected $dataCompany = array();

    protected function setUp()
    {
        $this->config = new \StdClass();
        $this->config->clientId = '61';
        $this->config->requestId = '12345';
        $this->config->userID = 'ccdach_demo_magento';
        $this->config->email = 'support@diglin.com';
        $this->config->password = 'myMagento77';

        $this->dataPerson = array(
            'customer_reference' => 'my reference',
            'person' => array(
                'first_name' => 'Sylvain',
                'last_name' => 'Rayé',
                'gender' => 1,
                'date_of_birth' => '1980-06-05', // YYYY-MM-DD
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
                    array(
                        'name' => 'DELIVERY_HOUSENUMBER',
                        'value' => '' // If empty error on API side
                    ),
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
                'company_name1' => 'Diglin GmbH',
                'current_address' => array(
                    'first_line' => 'Rütistasse',
                    'house_number' => '14',
                    'post_code' => '8952',
                    'country_code' => 'CH',
                    'town' => 'Schlieren',
                ),
                'ordering_person' => array(
                    'function' => 1,
                    'person' => array(
                        'first_name' => 'Sylvain',
                        'last_name' => 'Rayé',
                        'gender' => 1,
                        'date_of_birth' => '05.06.1980', // DD.MM.YYYY
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
                    array(
                        'name' => 'DELIVERY_HOUSENUMBER',
                        'value' => ''
                    ),
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

        parent::setUp();
    }

    public function testCreateXmlDocumentPerson()
    {
        $dom = new \DOMDocument("1.0", "UTF-8");

        /* @var $request Request */
        $request = $dom->appendChild(new Request());

        $request->setClientId($this->config->clientId);
        $request->setUserID($this->config->userID);
        $request->setPassword($this->config->password);
        $request->setEmail($this->config->email);
        $request->setRequestId($this->config->requestId);

        $request->createRequest($this->dataPerson);

//        libxml_use_internal_errors(false);
//        $dom->schemaValidate($request->getNoNamespaceSchemaLocation());
//        print $dom->saveXML();
//        die();

        libxml_use_internal_errors(true);
        $this->assertTrue($dom->schemaValidate($request->getNoNamespaceSchemaLocation()), 'DOM Document not valid for Person');
    }

    public function testCreateXmlDocumentCompany()
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

//        libxml_use_internal_errors(false);
//        $dom->schemaValidate($request->getNoNamespaceSchemaLocation());
//        print $dom->saveXML();

        libxml_use_internal_errors(true);
        $this->assertTrue($dom->schemaValidate($request->getNoNamespaceSchemaLocation()), 'DOM Document not valid for Company');
    }
}