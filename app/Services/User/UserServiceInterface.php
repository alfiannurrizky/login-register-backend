<?php

namespace App\Services\User;

interface UserServiceInterface
{
    public function save(array $data);

    public function login(array $data);

    public function refresh();

    public function getUser();

    public function logout();
}
