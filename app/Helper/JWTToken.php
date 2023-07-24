<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function createToken($userEmail)
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'Assignment_21',
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24,
            'userEmail' => $userEmail
        ];

        return JWT::encode($payload, $key, 'HS256');
    }
    public static function verifyToken($token)
    {
        try {
            $key = env('JWT_KEY');
            $decode = JWT::decode($token, new Key($key, 'HS256'));
            return $decode->userEmail;
        } catch (\Throwable $th) {
            return "Unauthenticated";
        }
    }
}
