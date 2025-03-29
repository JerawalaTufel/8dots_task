<?php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('decrypt_data')) {
    function decrypt_data($encrypted)
    {
        try {
            return Crypt::decrypt($encrypted);
        } catch (\Exception $e) {
            return null;
        }
    }
}
