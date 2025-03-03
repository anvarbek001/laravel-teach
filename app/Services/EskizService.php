<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EskizService {
    private $client;
    private $token;

    public function __construct() {
        $this->client = new Client(['base_uri' => 'https://notify.eskiz.uz/']);
        $this->token = cache()->get('eskiz_token'); // 🔵 Token keshdan olinadi

        if (!$this->token) {
            $this->token = $this->getAuthToken(); // 🔵 Token olinmasa, yangi token olamiz
        }
    }

    /**
     * 📌 Eskiz API dan token olish
     */
    public function getAuthToken() {
        try {
            $email = config('eskiz.eskiz_email');
            $password = config('eskiz.eskiz_password');

            $response = $this->client->post('/api/auth/login', [
                'json' => [
                    'email' => $email,
                    'password' => $password,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['data']['token'])) {
                $token = $data['data']['token'];
                cache()->put('eskiz_token', $token, now()->addMinutes(55)); // 🔵 Token 55 daqiqa keshlanadi
                return $token;
            }

            throw new \Exception("Eskiz token olinmadi!");
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * 📌 SMS yuborish
     */
    public function send_Sms($phone, $message) {
        if (!$this->token) {
            return ['status' => 'error', 'message' => 'Eskiz token olinmadi!'];
        }

        try {
            $response = $this->client->post('/api/message/sms/send', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
                'form_params' => [
                    'mobile_phone' => $phone,
                    'message' => $message,
                    'from' => config('eskiz.from', '4546'),
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'status' => 'error',
                'message' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    /**
     * 📌 SMS holatini tekshirish
     */
    public function checkSmsStatus($smsId) {
        if (!$this->token) {
            return ['status' => 'error', 'message' => 'Eskiz token olinmadi!'];
        }

        try {
            $response = $this->client->get("/api/message/sms/status/{$smsId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'status' => 'error',
                'message' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }
}
