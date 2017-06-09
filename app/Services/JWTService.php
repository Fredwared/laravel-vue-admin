<?php
namespace App\Services;


class JWTService extends ModelService
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getTokenTTL()
    {
        $payload = $this->decodeToken();

        return isset($payload['exp']) ? $payload['exp'] : 0;
    }

    private function decodeToken()
    {
        $payloadArray = [];
        $parts = $this->sliceToken();

        if (isset($parts[1])) {
            $json = base64_decode($parts[1]);
            $payloadArray = json_decode($json, true);
        }

        return $payloadArray;
    }

    private function sliceToken()
    {
        $parts = explode('.', $this->token);

        return count($parts) ? $parts : [];
    }
}