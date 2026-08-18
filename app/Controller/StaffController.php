<?php

namespace App\Controller;

use App\Core\Http;
use App\Core\Model;
use App\Core\Request;

class StaffController
{
    //dashboard
    public static function dashboard(Request $request)
    {
        $title = "Staff Dashboard";
        
        //get recent transactions limit 5
        $timetables = Model::all('timetables');
        return view('pages/index', ["title" => $title, 'timetables' => $timetables]);
    }
    public static function printTimeTable(Request $request, $args)
    {
        if($request->isGet()){
            $id = $args['id'];
            $timetable = Model::getSingle('timetables', 'id', $args['id']);
            $generated_timetable_list = Model::getWhere('generated_timetable', ['timetable_id' => $timetable->timetable_id], "date ASC", 999);
            
            return view('admin/print', compact('id','timetable','generated_timetable_list'));
        }
    }
    public static function notifications(Request $request)
    {
        $title = "Notifications";
        
        //get recent transactions limit 5
        $notifications = Model::all('notifications');
        return view('pages/notifications', ["title" => $title, 'notifications' => $notifications]);
    }
    public static function timeTable(Request $request, $args)
    {
        if($request->isGet()){
            $title = "Manage TimeTable";
            $id = $args['id'];
            $timetable = Model::getSingle('timetables', 'id', $args['id']);
            $generated_timetable_list = Model::getWhere('generated_timetable', ['timetable_id' => $timetable->timetable_id], "id DESC", 999);
            
            return view('pages/staff-timetable', compact('title','id','timetable','generated_timetable_list'));
        }
    }
    

    //profile
    public static function profile(Request $request)
    {
        if($request->method()=="POST"){
            try {
                $name = $request->input('name');
                //email
                $email = $request->input('email');
                //admission_number
                $username = $request->input('username');
                //level
                $rank = $request->input('rank');
                //password
                $password = $request->input('password');
                if(empty($name) || empty($email) || empty($username) || empty($rank)){
                    response_json(['code' => 400, 'message' => 'All Input are required']);
                }
                //hash password
                //$password = password_hash($password, PASSWORD_DEFAULT);
                //insert into database
                
                $dataQeury = [
                    'name' => $name,
                    'email' => $email,
                    'username' => $username,
                    'rank' => $rank,
                    'role' => 'staff',
                    'password' => $password
                ];
            
                //update the user
                $update = Model::update('users', $dataQeury, $auth()->getId());
                if ($update) {
                    response_json(['code' => 200, 'message' => 'Profile updated successfully']);
                } else {
                    response_json(['code' => 500, 'message' => 'Something went wrong']);
                }
            } catch (\Exception $e) {
                response_json([
                    "code" => 500,
                    "message" => $e->getMessage()
                ]);
            }
        }else {
            $title = "Profile";
            $staff = Model::getSingle('users', 'id', auth()->getId());
            return view('pages/staff-profile', compact('title', 'staff'));
        }
        
    }
    

    
}
