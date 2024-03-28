<?php
use App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken{
    public static  function createToken($email, $id):string
    {
        $key = env("JWT_KEY");
        $payload = [
            'iss' => "laravel-token",
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24,
            'email' => $email,
            'id' => $id
        ];
        return JWT::encode($payload, $key, 'HS256');
    }

    public static function decodeToken($token):string | object{
        try {
            if ($token == null) {
                return 'Unauthorized';
            }else{
                $key = env('JWT_KEY');
                $decode=  JWT::decode($token, new Key($key, 'HS256'));
                return $decode;
            }
        } catch (Exception $exception) {
            return "Unauthorized";
        }
    }


    public static function createTokenForPass($email){
        $key = env('JWT_KEY');
        $payload = [
            'iss' => "laravel_token",
            'iat' => time(),
            'exp' => time()+60*5,
            'email' => $email,
            'id' => '0'
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
    
}