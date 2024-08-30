<?php

namespace App\Services\Spillman;

class TimeUtils
{
    public function convertToSeconds($time)
    {
        $parts = explode(' ', $time);
        $seconds = 0;

        foreach ($parts as $part) {
            if (strpos($part, 'm') !== false) {
                $seconds += intval($part) * 60;
            } elseif (strpos($part, 's') !== false) {
                $seconds += intval($part);
            }
        }

        return $seconds;
    }
}