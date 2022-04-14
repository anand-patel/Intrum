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
 * Class Transport
 * @package Diglin\Intrum\CreditDecision
 */
class Transport
{

    const CREDITCHECK_URL_LIVE = 'https://credit-information-ws.ch/xmlServices/v.0.0/xml/workflow';
    const CREDITCHECK_URL_TEST = 'https://test-credit-information-ws.ch/xmlServices/v.0.0/xml/workflow';
    const PORT = 443;

    /**
     * @var string
     */
    protected $mode = 'test';

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     *
     * @return $this
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    public function sendRequest($xmlRequest, $timeout = 30)
    {
        if ($xmlRequest instanceof \DOMDocument) {
            $xmlRequest = $xmlRequest->saveXML();
        }

        if (intval($timeout) < 0) {
            $timeout = 30;
        }

        $ch = curl_init();

        if ($this->mode == 'live') {
            $url = self::CREDITCHECK_URL_LIVE;
        } else {
            $url = self::CREDITCHECK_URL_TEST;
        }

        $content = 'REQUEST='.urlencode($xmlRequest);

        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PORT           => self::PORT,
            CURLOPT_SSL_VERIFYHOST => 2,
//            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_0,
            CURLOPT_HTTPHEADER     => array('Content-Length' => mb_strlen($content), 'Host' => 'intrum.com'),
            CURLOPT_TIMEOUT        => $timeout,
        );

        $curlVersion = curl_version();
        if (version_compare($curlVersion['version'], '7.34', '>=') && version_compare(PHP_VERSION, '5.5.19', '>=')) {
            $options[CURLOPT_SSLVERSION] = CURL_SSLVERSION_TLSv1_2;
        } else {
            $options[CURLOPT_SSLVERSION] = CURL_SSLVERSION_TLSv1;
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            throw new \Exception('Curl Error with Intrum - curl error:'.curl_error($ch).' - curl errno:'.curl_errno($ch));
        }

        curl_close($ch);

        return $response;
    }
}
