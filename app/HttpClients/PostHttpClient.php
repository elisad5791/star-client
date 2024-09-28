<?php

namespace App\HttpClients;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PostHttpClient
{
    private const DOMAIN = 'http://star.test';
    private const ENDPOINT_POSTS = '/api/posts';
    private const ENDPOINT_LOGIN = '/api/login';

    private string $token;

    public static function make(): PostHttpClient
    {
        return new self();
    }

    public function login(): PostHttpClient
    {
        if (empty($this->token)) {
            $email = config('star.email', '');
            $password = config('star.password', '');
            if (empty($email) || empty($password)) {
                dd('Error: Email or password not found');
            }

            $data = compact('email', 'password');
            $result = Http::post(self::DOMAIN . self::ENDPOINT_LOGIN, $data)->collect();
            if (empty($result['access_token'])) {
                dd('Error: Login failed');
            }

            $this->token = $result['access_token'];
        }
        return $this;
    }

    public function index(array $filter = []): Collection
    {
        $res = Http::acceptJson()->withQueryParameters($filter)->get(self::DOMAIN . self::ENDPOINT_POSTS);
        return $this->result($res);
    }

    public function show(int $id): Collection
    {
        $check = $this->checkInputData(false, true, $id);
        if (!$check['success']) {
            return $check['error'];
        }

        $res = Http::acceptJson()->get(self::DOMAIN . self::ENDPOINT_POSTS .'/' . $id);
        return $this->result($res);
    }

    public function store(array $data): Collection
    {
        $check = $this->checkInputData(true, false);
        if (!$check['success']) {
            return $check['error'];
        }

        $res = Http::acceptJson()->withToken($this->token)->post(self::DOMAIN . self::ENDPOINT_POSTS, $data);
        return $this->result($res);
    }

    public function destroy(int $id): Collection
    {
        $check = $this->checkInputData(true, true, $id);
        if (!$check['success']) {
            return $check['error'];
        }

        $res = Http::acceptJson()->withToken($this->token)->delete(self::DOMAIN . self::ENDPOINT_POSTS . '/' . $id);
        return $this->result($res);
    }

    public function update(int $id, array $data): Collection
    {
        $check = $this->checkInputData(true, true, $id);
        if (!$check['success']) {
            return $check['error'];
        }

        $res = Http::acceptJson()->withToken($this->token)->patch(self::DOMAIN . self::ENDPOINT_POSTS .'/' . $id, $data);
        return $this->result($res);
    }

    protected function result($res)
    {
        if ($res->ok()) {
            return $res->collect();
        }
        if (!empty($res->object()->message)) {
            return collect(['error' => $res->object()->message]);
        }
        return collect(['error' => 'Error has occurred']);
    }

    protected function checkInputData(bool $checkToken,  bool $checkId, int $id = 0): array
    {
        if ($checkToken && empty($this->token)) {
            return ['success' => false, 'error' => collect(['error' => 'Token not found'])];
        }
        if ($checkId && $id < 1) {
            return ['success' => false, 'error' => collect(['error' => 'Invalid ID'])];
        }
        return ['success' => true];
    }
}
