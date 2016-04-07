<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Jose\Tests\Stub;

use Jose\JWKManagerInterface;
use Jose\JWKSetManager as Base;

class JWKSetManager extends Base
{
    protected $jwk_manager;

    public function setJWKManager(JWKManagerInterface $jwk_manager)
    {
        $this->jwk_manager = $jwk_manager;

        return $this;
    }

    protected function getJWKManager()
    {
        return $this->jwk_manager;
    }

    /**
     * {@inheritdoc}
     */
    public function createJWKSet(array $values = [])
    {
        $key_set = new JWKSet();
        foreach ($values as $value) {
            $key = $this->getJWKManager()->createJWK($value);
            $key_set->addKey($key);
        }

        return $key_set;
    }
}
