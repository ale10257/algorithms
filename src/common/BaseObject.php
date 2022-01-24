<?php

namespace ale10257\algorithms\common;

use InvalidArgumentException;

class BaseObject
{
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidArgumentException('Getting write-only property: ' . get_class($this) . '::' . $name);
        }

        throw new InvalidArgumentException('Getting unknown property: ' . get_class($this) . '::' . $name);
    }

    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidArgumentException('Setting read-only property: ' . get_class($this) . '::' . $name);
        } else {
            throw new InvalidArgumentException('Setting unknown property: ' . get_class($this) . '::' . $name);
        }
    }
}