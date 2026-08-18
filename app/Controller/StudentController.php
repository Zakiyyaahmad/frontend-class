<?php

namespace App\Controller;

use App\Core\Http;
use App\Core\Model;
use App\Core\Request;

class StudentController
{
    //dashboard
    public static function dashboard(Request $request)
    {
        $title = "Student Dashboard";
        
        //get recent transactions limit 5
        $timetables = Model::all('timetables','id DESC',999);
        return view('pages/index', ["title" => $title, 'timetables' => $timetables]);
    }
    public static function reports(Request $request)
    {
        $title = "Reports";
        
        //get recent transactions limit 5
        $reports = Model::getWhere('reports', ['user_id' => auth()->getId()], "id DESC", 999);
        return view('pages/reports', ["title" => $title, 'reports' => $reports]);
    }
    public static function addReport(Request $request)
    {
        if($request->isPost()){
            $message = $request->input('message');
            
            if(empty($message)){
                response_json(['code' => 400, 'message' => 'Message is required']);
            }

            $newCourse = Model::create('reports', [
                'message' => $message,
                'user_id' => auth()->getId(),
                'reply' => 'No reply',
            ]);
            if ($newCourse) {
                response_json(['code' => 200, 'message' => 'Report sent successful']);
            }
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add Report";
            //view
            return view('pages/add-report', compact('title'));
        }
    }
    public static function notifications(Request $request)
    {
        $title = "Notifications";
        
        //get recent transactions limit 5
        $notifications = Model::all('notifications','id DESC',999);
        return view('pages/notifications', ["title" => $title, 'notifications' => $notifications]);
    }
    public static function timeTable(Request $request, $args)
    {
        if($request->isGet()){
            $title = "Manage TimeTable";
            $id = $args['id'];
            $timetable = Model::getSingle('timetables', 'id', $args['id']);
            $generated_timetable_list = Model::getWhere('generated_timetable', ['timetable_id' => $timetable->timetable_id], "id DESC", 999);
            
            return view('pages/timetable', compact('title','id','timetable','generated_timetable_list'));
        }
    }
    public static function printTimeTable(Request $request, $args)
    {
        if($request->isGet()){
            $id = $args['id'];
            $timetable = Model::getSingle('timetables', 'id', $args['id']);
            $generated_timetable_list = Model::getWhere('generated_timetable', ['timetable_id' => $timetable->timetable_id], "date ASC", 999);
            
            return view('pages/print', compact('id','timetable','generated_timetable_list'));
        }
    }
    //profile
    public static function profile(Request $request)
    {
        if($request->method()=="POST"){
            
            $name = $request->input('name');
            //email
            $email = $request->input('email');
            //admission_number
            $admission_number = $request->input('admission_number');
            //password
            $password = $request->input('password');
            if(empty($name) || empty($email) || empty($admission_number) || empty($password)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }
            
            //hash password
            //$password = password_hash($password, PASSWORD_DEFAULT);
            //insert into database
            $dataQeury = [
                'name' => $name,
                'email' => $email,
                'username' => $admission_number,
                'password' => $password
            ];
        
            //update the user
            $update = Model::update('users', $dataQeury, auth()->getId());
            if ($update) {
                response_json(['code' => 200, 'message' => 'Profile updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
        }else {
            $title = "Profile";
            $student = Model::getSingle('users', 'id', auth()->getId());
            return view('pages/student-profile', compact('title', 'student'));
        }
        
    }
    

    
}
