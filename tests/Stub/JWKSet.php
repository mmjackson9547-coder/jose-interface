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

use Jose\JWKInterface;
use Jose\JWKSet as Base;

class JWKSet extends Base
{
    private $keys = [];

    public function getKeys()
    {
        return $this->keys;
    }

    public function addKey(JWKInterface $key)
    {
        $this->keys[] = $key;

        return $this;
    }

    public function removeKey($key)
    {
        if (array_key_exists($key, $this->keys)) {
            unset($this->keys[$key]);
        }

        return $this;
    }
}
