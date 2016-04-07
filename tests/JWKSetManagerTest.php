<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

use Jose\Tests\Stub\JWKManager;
use Jose\Tests\Stub\JWKSetManager;

class JWKSetManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testJKUGoogleKeys()
    {
        $header = [
            'alg' => 'foo',
            'jku' => 'https://www.googleapis.com/oauth2/v2/certs',
        ];
        $jwkset_manager = new JWKSetManager();
        $jwkset_manager->setJWKManager(new JWKManager());

        $result = $jwkset_manager->findByHeader($header);
        $this->assertInstanceOf("Jose\JWKSetInterface", $result);
        $this->assertEquals(2, count($result));
    }

    public function testX5UGoogleKeys()
    {
        $header = [
            'alg' => 'foo',
            'x5u' => 'https://www.googleapis.com/oauth2/v1/certs',
        ];
        $jwkset_manager = new JWKSetManager();
        $jwkset_manager->setJWKManager(new JWKManager());

        $result = $jwkset_manager->findByHeader($header);
        $this->assertInstanceOf("Jose\JWKSetInterface", $result);
        $this->assertEquals(2, count($result));
    }
}
