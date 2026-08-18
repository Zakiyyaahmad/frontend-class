<?php

namespace App\Controller;

use App\Core\Authentication;
use App\Core\Model;
use App\Core\Request;

class Auth
{
    //register
    public static function register(Request $request)
    {
        if($request->isPost()){
            try {
                $name = $request->input('name');
                //email
                $email = $request->input('email');
                //admission_number
                $admission_number = $request->input('admission_number');
                
                //password
                $password = $request->input('password');
                if(empty($name) || empty($email) || empty($admission_number) ){
                    response_json(['code' => 400, 'message' => 'All Input are required']);
                }
                //check if admission number already exists
                $user = Model::getSingle('users', 'username', $admission_number);
                if ($user) {
                    response_json(['code' => 400, 'message' => 'Admission Number already exists']);
                }
                //check if email already exists
                $user = Model::getSingle('users', 'email', $email);
                if ($user) {
                    response_json(['code' => 400, 'message' => 'Email already exists']);
                }
                //hash password
                //$password = password_hash($password, PASSWORD_DEFAULT);
                //insert into database
                $newUser = Model::create('users', [
                    'name' => $name,
                    'email' => $email,
                    'username' => $admission_number,
                
                    'role' => 'student',
                    'password' => $password
                ]);
                if ($newUser) {
                    response_json(['code' => 200, 'message' => 'Registration successful', 'redirect' => url('login')]);
                }
                //if something goes wrong
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            } catch (\Exception $e) {
                response_json(['code' => 500, 'message' => $e->getMessage()]);
            }
        }else{
            return view('auth/register');
        }
        
    }

    //login
    public static function login(Request $request)
    {
        if($request->isPost()){
            try {
                $username = $request->input('username');
                $password = $request->input('password');
                if(empty($username) || empty($password)){
                    response_json(['code' => 400, 'message' => 'All Input are required']);
                }
                //check if email exists
                $user = Model::getSingle('users', 'username', $username);
                if (!$user) {
                    response_json(['code' => 400, 'message' => 'User does not exist']);
                }
                //password verify
                if ($password != $user->password) {
                    response_json(['code' => 400, 'message' => 'Invalid password']);
                }
                // if (!password_verify($password, $user->password)) {
                //     response_json(['code' => 400, 'message' => 'Invalid password']);
                // }
                //login user
                $auth = new Authentication;
                if ($auth->login($user)) {
                    //check if user role is admin
                    if ($user->role == 'admin') {
                        response_json(['code' => 200, 'message' => 'Login successful', 'redirect' => url('admin')]);
                    }else if ($user->role == 'staff') {
                        response_json(['code' => 200, 'message' => 'Login successful', 'redirect' => url('staff')]);
                    } else {
                        response_json(['code' => 200, 'message' => 'Login successful', 'redirect' => url('student')]);
                    }
                }
                //if something goes wrong
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            } catch (\Exception $e) {
                response_json(['code' => 500, 'message' => $e->getMessage()]);
            }
        }else{
            return view('auth/signin');
        }
        
    }

    //logout
    public static function logout(Request $request)
    {
        $auth = new Authentication;
        if ($auth->logout()) {
            redirect('login');
        }
    }
}
