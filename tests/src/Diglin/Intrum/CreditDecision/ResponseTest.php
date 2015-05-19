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
 * Class ResponseTest
 * @package Diglin\Intrum\CreditDecision
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $xml;

    protected $xmlError;

    protected $data = array();

    protected function setUp()
    {
        $this->xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<Response RequestId="12345" ResponseId="10002345" Version="1.0" ClientId="45"
          xsi:noNamespaceSchemaLocation="http://site.intrum.ch/schema/CreditDecisionResponse131.xsd"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <ProcessingInfo>
        <Code>POS-00000</Code>
        <Classification>INF</Classification>
        <Description>normal processing</Description>
    </ProcessingInfo>
    <Customer IJReference="12342221" Reference="3344215234">
        <RequestStatus>2</RequestStatus>
        <LastStatusChange>2001-12-17T09:30:47.0Z</LastStatusChange>
        <ProcessingInfo>
            <Code>POS-00000</Code>
            <Classification>INF</Classification>
            <Description>normal processing</Description>
        </ProcessingInfo>
    </Customer>
</Response>
XML;

        $this->xmlError = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<Response RequestId="12345" ResponseId="10002345" Version="1.0" ClientId="45"
          xsi:noNamespaceSchemaLocation="http://site.intrum.ch/schema/CreditDecisionResponse131.xsd"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <ProcessingInfo>
        <Code>POS-00000</Code>
        <Classification>ERR</Classification>
        <Description>normal processing</Description>
    </ProcessingInfo>
    <Customer IJReference="12342221" Reference="3344215234">
        <RequestStatus>2</RequestStatus>
        <LastStatusChange>2001-12-17T09:30:47.0Z</LastStatusChange>
        <ProcessingInfo>
            <Code>POS-00000</Code>
            <Classification>ERR</Classification>
            <Description>normal processing</Description>
        </ProcessingInfo>
    </Customer>
</Response>
XML;

        parent::setUp();
    }

    public function testResponse()
    {
        $response = new Response();
        $response->setRawResponse($this->xml);
        $response->processResponse();

        $this->assertContains('INF', $response->getProcessingInfoClassification(), 'INF Classification not found');
    }

    public function testResponseError()
    {
        $response = new Response();
        $response->setRawResponse($this->xmlError);
        $response->processResponse();

        $this->assertContains('ERR', $response->getProcessingInfoClassification(), 'ERR Classification not found');
    }
}

