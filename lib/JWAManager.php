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

abstract class JWAManager implements JWAManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function isAlgorithmSupported($algorithm)
    {
        return null !== $this->getAlgorithm($algorithm);
    }
}
