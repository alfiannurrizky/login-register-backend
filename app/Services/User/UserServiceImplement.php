<?php

namespace App\Services\User;
use App\Models\User;

class UserServiceImplement implements UserServiceInterface
{
    public function save($data)
    {
        $user = new User;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->saveOrFail();

        return $user;
    }

    public function login(array $data)
    {
        $token = auth()->attempt($data);

        return $token;

    }

    public function refresh()
    {

    }

    public function getUser()
    {

    }

    public function logout()
    {

    }
}