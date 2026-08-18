<?php

namespace App\Core;

class Authentication
{
    //instance
    public function instance()
    {
        return new Authentication;
    }
    //login
    public function login($user)
    {
        $session = new Session;
        $session->set('user', $user);
        return true;
    }

    //logout
    public function logout()
    {
        $session = new Session;
        $session->delete('user');
        return true;
    }

    //user
    public function user()
    {
        $session = new Session;
        return $session->get('user');
    }

    //checkLogin
    public function checkLogin()
    {
        $session = new Session;
        return $session->has('user');
    }

    //checkAdmin
    public function checkAdmin()
    {
        $session = new Session;
        $user = $session->get('user');
        if ($user->role == 'admin') {
            return true;
        }
        return false;
    }

    //get name
    public function getName()
    {
        $session = new Session;
        $user = $session->get('user');
        return $user->first_name . ' ' . $user->last_name;
    }

    //get email
    public function getEmail()
    {
        $session = new Session;
        $user = $session->get('user');
        return $user->email;
    }

    //get role
    public function getRole()
    {
        $session = new Session;
        $user = $session->get('user');
        return $user->role;
    }

    //get id
    public function getId()
    {
        $session = new Session;
        $user = $session->get('user');
        return $user->id;
    }

    //get first name
    public function getFirstName()
    {
        $session = new Session;
        $user = $session->get('user');
        return $user->first_name;
    }

    //get last name
    public function getLastName()
    {
        $session = new Session;
        $user = $session->get('user');
        return $user->last_name;
    }

    //get phone
    public function getPhone()
    {
        $session = new Session;
        $user = $session->get('user');
        return $user->phone;
    }
}
