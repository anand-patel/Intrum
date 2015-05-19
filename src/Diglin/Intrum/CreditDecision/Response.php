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
 * Class Response
 * @package Diglin\Intrum\CreditDecision
 */
class Response
{
    /**
     * @var string
     */
    private $rawResponse;

    /**
     * @var int
     */
    private $responseId;

    /**
     * @var double
     */
    private $version;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $processingInfoCode;

    /**
     * @var string
     */
    private $processingInfoClassification;

    /**
     * @var string
     */
    private $processingInfoDescription;

    /**
     * @var string
     */
    private $customerRequestStatus;

    /**
     * @var string
     */
    private $customerLastStatusChange;

    /**
     * @var string
     */
    private $customerProcessingInfoCode;

    /**
     * @var string
     */
    private $customerProcessingInfoClassification;

    /**
     * @var string
     */
    private $customerProcessingInfoDescription;

    /**
     * @var string
     */
    private $customerCreditRating;

    /**
     * @var string
     */
    private $customerCreditRatingLevel;

    /**
     * @return $this
     */
    public function processResponse()
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($this->rawResponse);

        $this->customerCreditRating = '';
        $this->customerCreditRatingLevel = '';

        if (!$xml) {
            $this->responseId = '0';
            $this->version = '0';
            $this->clientId = '0';

            $this->processingInfoCode = '0';
            $this->processingInfoClassification = 'ERR';

            if ($this->processingInfoClassification == 'ERR') {
                $this->customerRequestStatus = 0;

                return $this;
            }
        }

        $this->responseId = (int) $xml->ResponseId;
        $this->version = (double) $xml->Version;
        $this->clientId = (int) $xml->ClientId;

        $this->processingInfoCode = trim((string) $xml->ProcessingInfo->Code);
        $this->processingInfoClassification = trim((string) $xml->ProcessingInfo->Classification);

        if ($this->processingInfoClassification == 'ERR') {
            $this->customerRequestStatus = 0;

            return $this;
        }

        $this->processingInfoDescription = trim((string) $xml->ProcessingInfo->Description);

        if (!empty($xml->Customer->CreditRating)) {
            $this->customerCreditRating = trim((string) $xml->Customer->CreditRating);
        }

        if (!empty($xml->Customer->CreditRatingLevel)) {
            $this->customerCreditRatingLevel = trim((string) $xml->Customer->CreditRatingLevel);
        }

        $this->customerRequestStatus = (int) $xml->Customer->RequestStatus;
        $this->customerLastStatusChange = trim((string) $xml->Customer->RequestStatus);
        $this->customerProcessingInfoCode = trim((string) $xml->Customer->ProcessingInfo->Code);
        $this->customerProcessingInfoClassification = trim((string) $xml->Customer->ProcessingInfo->Classification);
        $this->customerProcessingInfoDescription = trim((string) $xml->Customer->ProcessingInfo->Description);

        return $this;
    }

    /**
     * @return string
     */
    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    /**
     * @param string $rawResponse
     * @return $this
     */
    public function setRawResponse($rawResponse)
    {
        $this->rawResponse = $rawResponse;

        return $this;
    }

    /**
     * @return int
     */
    public function getResponseId()
    {
        return $this->responseId;
    }

    /**
     * @param int $responseId
     * @return $this
     */
    public function setResponseId($responseId)
    {
        $this->responseId = $responseId;

        return $this;
    }

    /**
     * @return double
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param double $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

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
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcessingInfoCode()
    {
        return $this->processingInfoCode;
    }

    /**
     * @param string $processingInfoCode
     * @return $this
     */
    public function setProcessingInfoCode($processingInfoCode)
    {
        $this->processingInfoCode = $processingInfoCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcessingInfoClassification()
    {
        return $this->processingInfoClassification;
    }

    /**
     * @param string $processingInfoClassification
     * @return $this
     */
    public function setProcessingInfoClassification($processingInfoClassification)
    {
        $this->processingInfoClassification = $processingInfoClassification;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcessingInfoDescription()
    {
        return $this->processingInfoDescription;
    }

    /**
     * @param string $processingInfoDescription
     * @return $this
     */
    public function setProcessingInfoDescription($processingInfoDescription)
    {
        $this->processingInfoDescription = $processingInfoDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRequestStatus()
    {
        return $this->customerRequestStatus;
    }

    /**
     * @param string $customerRequestStatus
     * @return $this
     */
    public function setCustomerRequestStatus($customerRequestStatus)
    {
        $this->customerRequestStatus = $customerRequestStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerLastStatusChange()
    {
        return $this->customerLastStatusChange;
    }

    /**
     * @param string $customerLastStatusChange
     * @return $this
     */
    public function setCustomerLastStatusChange($customerLastStatusChange)
    {
        $this->customerLastStatusChange = $customerLastStatusChange;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerProcessingInfoCode()
    {
        return $this->customerProcessingInfoCode;
    }

    /**
     * @param string $customerProcessingInfoCode
     * @return $this
     */
    public function setCustomerProcessingInfoCode($customerProcessingInfoCode)
    {
        $this->customerProcessingInfoCode = $customerProcessingInfoCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerProcessingInfoClassification()
    {
        return $this->customerProcessingInfoClassification;
    }

    /**
     * @param string $customerProcessingInfoClassification
     * @return $this
     */
    public function setCustomerProcessingInfoClassification($customerProcessingInfoClassification)
    {
        $this->customerProcessingInfoClassification = $customerProcessingInfoClassification;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerProcessingInfoDescription()
    {
        return $this->customerProcessingInfoDescription;
    }

    /**
     * @param string $customerProcessingInfoDescription
     * @return $this
     */
    public function setCustomerProcessingInfoDescription($customerProcessingInfoDescription)
    {
        $this->customerProcessingInfoDescription = $customerProcessingInfoDescription;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCreditRating()
    {
        return $this->customerCreditRating;
    }

    /**
     * @param string $customerCreditRating
     * @return $this
     */
    public function setCustomerCreditRating($customerCreditRating)
    {
        $this->customerCreditRating = $customerCreditRating;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCreditRatingLevel()
    {
        return $this->customerCreditRatingLevel;
    }

    /**
     * @param string $customerCreditRatingLevel
     * @return $this
     */
    public function setCustomerCreditRatingLevel($customerCreditRatingLevel)
    {
        $this->customerCreditRatingLevel = $customerCreditRatingLevel;

        return $this;
    }
}
