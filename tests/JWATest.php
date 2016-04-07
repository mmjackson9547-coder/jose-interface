<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

use Jose\Tests\Stub\JWAManager;

class JWATest extends \PHPUnit_Framework_TestCase
{
    public function testJWE()
    {
        $jwa_manager = new JWAManager();

        $jwa_manager->addAlgorithm('foo', 'bar');

        $this->assertTrue($jwa_manager->isAlgorithmSupported('foo'));
        $this->assertFalse($jwa_manager->isAlgorithmSupported('bar'));
    }
}
