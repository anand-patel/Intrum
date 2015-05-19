<?php
/**
 * Diglin GmbH - Switzerland
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     Diglin_Intrum
 * @copyright   Copyright (c) 2011-2015 Diglin (http://www.diglin.com)
 */
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(dirname(__DIR__) . '/tests/src'));

$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->add('Diglin\\Intrum', __DIR__ . '/src');