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

abstract class JWKSet implements JWKSetInterface
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @return \Jose\JWKInterface[]
     */
    abstract public function getKeys();

    /**
     * Add a key.
     *
     * @param \Jose\JWKInterface $key A JWKInterface objects
     *
     * @return self
     */
    abstract public function addKey(JWKInterface $key);

    /**
     * Remove a key.
     *
     * @param \Jose\JWKInterface $key A JWKInterface objects
     *
     * @return self
     */
    abstract public function removeKey($key);

    public function jsonSerialize()
    {
        return ['keys' => array_values($this->getKeys())];
    }

    public function count($mode = COUNT_NORMAL)
    {
        return count($this->getKeys(), $mode);
    }

    public function offsetExists($offset)
    {
        $keys = $this->getKeys();

        return isset($keys[$offset]);
    }

    /**
     * @param int $offset
     *
     * @return bool
     */
    public function offsetGet($offset)
    {
        $keys = $this->getKeys();

        return isset($keys[$offset]) ? $keys[$offset] : null;
    }

    public function offsetSet($offset, $key)
    {
        $this->addKey($key);
    }

    public function offsetUnset($offset)
    {
        $this->removeKey($offset);
    }

    public function current()
    {
        return $this->offsetGet($this->position);
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return $this->current() instanceof JWKInterface;
    }
}
