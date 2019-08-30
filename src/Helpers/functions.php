<?php

if (!function_exists('bool_catch')) {
    function bool_catch(callable $function, &$exception = null): bool
    {
        try {
            call_user_func($function);
        } catch (\Exception $e) {
            $exception = $e;
            return false;
        }

        return true;
    }
}
