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

use Base64Url\Base64Url;

/**
 */
abstract class JWKManager implements JWKManagerInterface
{
    /**
     * @return string[]
     */
    protected function getSupportedMethods()
    {
        return [
            'findByJWK',
            'findByX5C',
        ];
    }

    /**
     * @param array $header
     *
     * @return \Jose\JWKInterface
     */
    public function findByHeader(array $header)
    {
        // If the algorithm is none, we can return directly the key.
        if (array_key_exists('alg', $header) && 'none' === $header['alg']) {
            return $this->createJWK(['kty' => 'none']);
        }
        // Else, we try to find the correct key using methods declared in `getSupportedMethods`
        foreach ($this->getSupportedMethods() as $method) {
            if (!method_exists($this, $method)) {
                throw new \RuntimeException(sprintf('The method "%s" does not exist.', $method));
            }
            $result = $this->$method($header);
            if ($result instanceof JWKInterface) {
                return $result;
            }
        }
    }

    /**
     * @param $header
     *
     * @return \Jose\JWKInterface|null
     */
    protected function findByJWK($header)
    {
        if (!isset($header['jwk'])) {
            return;
        }

        $jwk = $this->createJWK($header['jwk']);

        return $jwk;
    }

    /**
     * @param $header
     *
     * @return \Jose\JWKInterface|null
     */
    protected function findByX5C($header)
    {
        if (!isset($header['x5c'])) {
            return;
        }
        if (is_array($header['x5c'])) {
            return $this->loadX5CCertificateChain($header['x5c']);
        } else {
            return;
        }
    }

    /**
     * @param array $chain
     *
     * @return \Jose\JWKInterface|null
     */
    protected function loadX5CCertificateChain(array $chain)
    {
        $certificate = reset($chain);
        $last_issuer = null;
        $last_subject = null;
        foreach ($chain as $cert) {
            $current_cert = "-----BEGIN CERTIFICATE-----\n$cert\n-----END CERTIFICATE-----";
            $x509 = openssl_x509_read($current_cert);
            if (false === $x509) {
                $last_issuer = null;
                $last_subject = null;
                break;
            }
            $parsed = openssl_x509_parse($x509);
            if (false === $parsed) {
                $last_issuer = null;
                $last_subject = null;
                break;
            }
            if (null === $last_subject) {
                $last_subject = $parsed['subject'];
                $last_issuer = $parsed['issuer'];
                $certificate = $current_cert;
            } else {
                if (implode('', $last_issuer) === implode('', $parsed['subject'])) {
                    $last_subject = $parsed['subject'];
                    $last_issuer = $parsed['issuer'];
                } else {
                    $last_issuer = null;
                    $last_subject = null;
                    break;
                }
            }
        }
        if (null === $last_issuer || implode('', $last_issuer) !== implode('', $last_subject)) {
            return;
        }

        return $this->converX5CToJWK($certificate);
    }

    /**
     * @param $x5c
     *
     * @return \Jose\JWKInterface|null
     */
    protected function converX5CToJWK($x5c)
    {
        if (false === $res = openssl_pkey_get_public($x5c)) {
            return;
        }

        $details = openssl_pkey_get_details($res);
        if (!is_array($details) || !array_key_exists('rsa', $details)) {
            return;
        }
        $values = [];
        foreach ($details['rsa'] as $key => $value) {
            $values[$key] = Base64Url::encode($value);
        }

        return $this->createJWK($values);
    }
}
