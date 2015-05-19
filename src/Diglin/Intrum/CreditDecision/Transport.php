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
 * Class Transport
 * @package Diglin\Intrum\CreditDecision
 */
class Transport
{
    const INTRUM_URL                  = 'https://secure.intrum.ch';
    const CREDITCHECK_RESPONSE_LIVE   = '/services/creditCheckDACH_01_41/response.cfm';
    const CREDITCHECK_RESPONSE_TEST   = '/services/creditCheckDACH_01_41_TEST/response.cfm';
    const PORT                        = 443;

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
            $url = self::INTRUM_URL . self::CREDITCHECK_RESPONSE_LIVE;
        } else {
            $url = self::INTRUM_URL . self::CREDITCHECK_RESPONSE_TEST;
        }

        $content = urlencode('REQUEST=' . $xmlRequest);

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_PORT => self::PORT,
            CURLOPT_SSL_VERIFYHOST => 2,
//            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_0,
            CURLOPT_HTTPHEADER => array('Content-Length' => mb_strlen($content), 'Host' => 'intrum.com'),
            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2, // only for curl lib > 7.34
            CURLOPT_TIMEOUT => $timeout,
        );

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            throw new \Exception('Curl Error with Intrum - curl error:' . curl_error($ch) . ' - curl errno:' . curl_errno($ch));
        }

        curl_close($ch);

        return $response;
    }
}