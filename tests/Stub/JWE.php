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

use Jose\JWE as Base;
use Jose\JWEInterface;

class JWE extends Base implements JWEInterface
{
    private $input = null;
    private $encoded_payload = null;
    private $encoded_protected_header = null;
    private $payload = null;
    private $protected_header = [];
    private $unprotected_header = [];

    /**
     * @var string|null
     */
    private $ciphertext;

    /**
     * @var string|null
     */
    private $encrypted_key;

    /**
     * @var string|null
     */
    private $iv;

    /**
     * @var string|null
     */
    private $aad;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * {@inheritdoc}
     */
    public function getCiphertext()
    {
        return $this->ciphertext;
    }

    /**
     * {@inheritdoc}
     */
    public function setCiphertext($ciphertext)
    {
        $this->ciphertext = $ciphertext;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEncryptedKey()
    {
        return $this->encrypted_key;
    }

    /**
     * {@inheritdoc}
     */
    public function setEncryptedKey($encrypted_key)
    {
        $this->encrypted_key = $encrypted_key;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAAD()
    {
        return $this->aad;
    }

    /**
     * {@inheritdoc}
     */
    public function setAAD($aad)
    {
        $this->aad = $aad;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIV()
    {
        return $this->iv;
    }

    /**
     * {@inheritdoc}
     */
    public function setIV($iv)
    {
        $this->iv = $iv;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * {@inheritdoc}
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

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

    public function getInput()
    {
        return $this->input;
    }

    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }
}
