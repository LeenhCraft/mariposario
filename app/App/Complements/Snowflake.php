<?php

namespace App\Complements;

use Exception;

class Snowflake
{
    private $epoch = 1577836800000;
    private $nodeId;
    private $sequence = 0;
    private $lastTimestamp = -1;
    private $nodeIdShift = 10;
    private $timestampShift = 12;
    private $sequenceMask = 4095; // 0b111111111111

    public function __construct($nodeId)
    {
        $this->nodeId = $nodeId;
    }

    public function generateId()
    {
        $timestamp = $this->getCurrentTimestamp();

        if ($timestamp == $this->lastTimestamp) {
            $this->sequence = ($this->sequence + 1) & $this->sequenceMask;
            if ($this->sequence == 0) {
                $timestamp = $this->getNextTimestamp();
            }
        } else {
            $this->sequence = 0;
        }

        if ($timestamp < $this->lastTimestamp) {
            throw new Exception("Invalid system clock");
        }

        $this->lastTimestamp = $timestamp;

        $id = (($timestamp - $this->epoch) << $this->timestampShift) |
            ($this->nodeId << $this->nodeIdShift) |
            $this->sequence;

        return $id;
    }

    private function getNextTimestamp()
    {
        $timestamp = $this->getCurrentTimestamp();
        while ($timestamp <= $this->lastTimestamp) {
            $timestamp = $this->getCurrentTimestamp();
        }
        return $timestamp;
    }

    private function getCurrentTimestamp()
    {
        return (int)(microtime(true) * 1000);
    }
}
