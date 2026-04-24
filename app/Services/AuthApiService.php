<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthApiService
{
    private string $apiKey = "go0kcs44w8o4wkk88s08o400s800oowo0g00oooc";
    private string $apiUrl = "http://10.10.10.69/rest/api/security/authentication/username/passord";

    public function authenticate(string $username, string $password): array
    {
        // ส่ง POST ไปยัง API
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->asForm()->post($this->apiUrl, [
            'username' => $username,
            'password' => $password,
        ]);

        // ถ้า API ล่ม หรือ timeout
        if ($response->failed()) {
            return [
                'success' => false,
                'error'   => 'Connection to API failed: ' . $response->body()
            ];
        }

        $json = $response->json();

        // ถ้า JSON ไม่ถูกต้อง
        if (!is_array($json)) {
            return [
                'success' => false,
                'error' => 'Invalid JSON returned from API'
            ];
        }

        // ถ้า API ตอบว่าไม่ผ่าน
        if (($json['status'] ?? false) == false) {
            return [
                'success' => false,
                'error' => $json['message'] ?? 'Unknown error'
            ];
        }

        return [
            'success' => true,
            'data' => $json
        ];
    }
}
