<?php

namespace App\Helpers\Hasher;

use Illuminate\Contracts\Hashing\Hasher;

class MD5Hasher implements Hasher
{
    public function info($hashedValue)
    {
        return password_get_info($hashedValue);
    }

    public function check($value, $hashedValue, array $options = [])
    {
        return $this->make($value) === $hashedValue;
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }

    public function make($value, array $options = [])
    {
        $value = env('SALT', '').$value;

//        dd(md5($value));
        return md5($value);
    }

}