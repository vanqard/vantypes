<?php
namespace Vanqard\VanTypes\JsonDateTime;

/**
 * Class JsonDateTime
 * @package Vanqard\VanTypes\JsonDateTime
 */
class JsonDateTime extends \DateTime implements \JsonSerializable
{
    /**
     * @return $this
     */
    public function zeroHours()
    {
        $this->setTime(0, 0, 0);
        return $this;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->format('c');
    }
}
