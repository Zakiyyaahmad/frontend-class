<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\Model;
use App\Core\Request;

class HomeController
{
    public static function index(Request $request)
    {
        $title = "Dashboard";
        
        return view('pages/index', compact('title'));
    }
    public static function venues(Request $request)
    {
        $title = "Venues";
        
        return view('pages/venues', compact('title'));
    }
    public static function students(Request $request)
    {
        $title = "Students";
        
        return view('pages/students', compact('title'));
    }
    public static function staffs(Request $request)
    {
        $title = "Staffs";
        
        return view('pages/staffs', compact('title'));
    }
    public static function profile(Request $request)
    {
        $title = "Profile";
        
        return view('pages/staffs', compact('title'));
    }
    //login
    public static function login(Request $request)
    {
        return view('auth/signin');
    }

    //register
    public static function register(Request $request)
    {
        return view('auth/register');
    }

}
