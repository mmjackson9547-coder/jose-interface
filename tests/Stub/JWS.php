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

use Jose\JWS as Base;
use Jose\JWSInterface;

class JWS extends Base implements JWSInterface
{
    private $encoded_payload = null;
    private $encoded_protected_header = null;
    private $input = null;
    private $payload = null;
    private $signature = null;
    private $protected_header = [];
    private $unprotected_header = [];

    public function getProtectedHeader()
    {
        return $this->protected_header;
    }

    public function setProtectedHeader(array $protected_header)
    {
        $this->protected_header = $protected_header;

        return $this;
    }

    public function setProtectedHeaderValue($key, $value)
    {
        $this->protected_header[$key] = $value;

        return $this;
    }

    public function getUnprotectedHeader()
    {
        return $this->unprotected_header;
    }

    public function setUnprotectedHeader(array $unprotected_header)
    {
        $this->unprotected_header = $unprotected_header;

        return $this;
    }

    public function setUnprotectedHeaderValue($key, $value)
    {
        $this->unprotected_header[$key] = $value;

        return $this;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }

    public function getSignature()
    {
        return $this->signature;
    }

    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    public function getEncodedProtectedHeader()
    {
        return $this->encoded_protected_header;
    }

    public function setEncodedProtectedHeader($encoded_protected_header)
    {
        $this->$encoded_protected_header = $encoded_protected_header;

        return $this;
    }

    public function getEncodedPayload()
    {
        return $this->encoded_payload;
    }

    public function setEncodedPayload($encoded_payload)
    {
        $this->encoded_payload = $encoded_payload;

        return $this;
    }
}
