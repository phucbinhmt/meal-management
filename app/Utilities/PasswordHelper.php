<?php

namespace App\Utilities;

use Illuminate\Support\Str;

class PasswordHelper
{
    public static function generateStrongPassword($length = 8)
    {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*()_+{}[];<>?,./';

        $allChars = $lowercase . $uppercase . $numbers . $specialChars;
        $password = '';

        // Thêm ít nhất một ký tự từ mỗi loại
        $password .= substr(str_shuffle($lowercase), 0, 1);
        $password .= substr(str_shuffle($uppercase), 0, 1);
        $password .= substr(str_shuffle($numbers), 0, 1);
        $password .= substr(str_shuffle($specialChars), 0, 1);

        // Thêm các ký tự ngẫu nhiên cho đến khi đủ độ dài
        $password .= substr(str_shuffle($allChars), 0, $length - 4);

        return str_shuffle($password); // Trộn ngẫu nhiên chuỗi để tăng độ mạnh của mật khẩu
    }
}