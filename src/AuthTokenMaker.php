<?php

namespace JarirAhmed\AuthTokenMaker;

use InvalidArgumentException;

class AuthTokenMaker
{
    /**
     * Generate a cryptographically secure random auth token of the exact requested length.
     *
     * The token is hex (characters 0-9a-f). Works for both odd and even lengths.
     *
     * @param int $length Number of characters (default 60). Must be >= 1.
     * @return string
     * @throws InvalidArgumentException
     */
    public static function generate($length = 60)
    {
        $length = (int) $length;
        if ($length < 1) {
            throw new InvalidArgumentException('Token length must be greater than zero.');
        }

        // 2 hex chars per byte; round up then trim so odd lengths are exact.
        $bytes = (int) ceil($length / 2);
        return substr(bin2hex(random_bytes($bytes)), 0, $length);
    }
}
