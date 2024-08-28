<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTHelper
{

    public static function CreateToken($userEmail,$userID){
        $key="123-xyz-abc";
        $payload=[
            'iss'=>'laravel-demo',
            'iat'=>time(),
            'exp'=>time()+60*60,
            'userEmail'=>$userEmail,
            'userID'=>$userID
        ];
        return JWT::encode($payload,$key,'HS256');
    }

    public static function DecodeToken($token){
        try {
            if($token==null){
                return "unauthorized";
            }
            else{
                $key="123-xyz-abc";
                return JWT::decode($token,new Key($key,'HS256'));
            }

        }catch (Exception $exception){
            return "unauthorized";
        }

    }

}
