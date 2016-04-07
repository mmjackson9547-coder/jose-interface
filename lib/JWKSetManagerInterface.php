<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose;

/**
 * Interface representing a JSON Web Key Set Manager.
 */
interface JWKSetManagerInterface
{
    /**
     * Find key using the header.
     * This method will check headers used to identify a unique key ('jku', 'x5u'...).
     *
     * @param array $header The header
     *
     * @return \Jose\JWKSetInterface|null Returns a JWKSetInterface object that may contain key set found according to the header
     */
    public function findByHeader(array $header);

    /**
     * Create a JWKSet object.
     *
     * @param array $values The values to set.
     *
     * @return \Jose\JWKSetInterface Returns a JWKSetInterface object
     */
    public function createJWKSet(array $values = []);
}
