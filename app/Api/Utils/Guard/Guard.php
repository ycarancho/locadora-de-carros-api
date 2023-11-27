<?php

namespace app\Api\Utils\Guard;

use Exception;

class Guard
{
    public static function check(Bool $role, String $message)
    {
        if ($role) {
            throw new Exception($message);
        }
    }
}
