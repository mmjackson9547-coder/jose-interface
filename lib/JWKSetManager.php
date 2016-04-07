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
abstract class JWKSetManager implements JWKSetManagerInterface
{
    /**
     * @return \Jose\JWKManagerInterface
     */
    abstract protected function getJWKManager();

    /**
     * @return string[]
     */
    protected function getSupportedMethods()
    {
        return [
            'findByJKU',
            'findByX5U',
        ];
    }

    /**
     * @param array $header
     *
     * @return \Jose\JWKSetInterface|null
     */
    public function findByHeader(array $header)
    {
        foreach ($this->getSupportedMethods() as $method) {
            if (!method_exists($this, $method)) {
                throw new \RuntimeException("The method '$method' does not exist.");
            }
            $result = $this->$method($header);
            if ($result instanceof JWKSetInterface) {
                return $result;
            } elseif ($result instanceof JWKInterface) {
                $keyset = $this->createJWKSet();
                $keyset->addKey($result);

                return $keyset;
            }
        }
    }

    /**
     * @param $header
     *
     * @return \Jose\JWKSetInterface|null
     */
    protected function findByJKU($header)
    {
        if (!isset($header['jku'])) {
            return;
        }

        $content = $this->downloadContent($header['jku']);
        if (null === $content) {
            return;
        }
        $content = json_decode($content, true);
        if (!is_array($content) || !array_key_exists('keys', $content)) {
            return;
        }

        $jwk_set = $this->createJWKSet($content['keys']);

        return $jwk_set;
    }

    /**
     * @param $header
     *
     * @return \Jose\JWKSetInterface|null
     */
    protected function findByX5U($header)
    {
        if (!isset($header['x5u'])) {
            return;
        }

        $content = $this->downloadContent($header['x5u']);
        if (null === $content) {
            return;
        }

        $content = json_decode($content, true);
        if (!is_array($content)) {
            return false;
        }

        $jwk_set = $this->createJWKSet();
        foreach ($content as $kid => $cert) {
            $jwk = $this->convertX5CToJWK($cert);
            if (null === $jwk) {
                break;
            }
            $jwk_set->addKey($jwk);
        }

        return $jwk_set;
    }

    /**
     * @param string $x5c
     *
     * @return \Jose\JWKInterface|null
     */
    protected function convertX5CToJWK($x5c)
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

        return $this->getJWKManager()->createJWK($values);
    }

    /**
     * @param string $url
     *
     * @return string|void
     */
    protected function downloadContent($url)
    {
        // The URL must be a valid URL and scheme must be https
        if (false === filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED) || 'https://' !== substr($url, 0, 8)) {
            return;
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_URL            => $url,
        ]);
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
}
