<?php

namespace App\Controller;

use App\Core\Database;
use App\Core\Model;
use App\Core\Request;

class AdminController
{
    /**
     * Index Page
     * @param Request $request
     */
    public static function index(Request $request)
    {
        $title = "Admin Dashboard";
        $timetables = Model::all('timetables','id DESC',999);
        //view
        return view('admin/index', compact('title', 'timetables'));
    }
    public static function addTimeTable(Request $request)
    {
        if($request->isPost()){
            $timetable_name = $request->input('timetable_name');
            //session_name
            $session_name = $request->input('session_name');
            $type = $request->input('type');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $timetable_id = rand(time(),10000000);
            $newTimetable = Model::create('timetables', [
                'timetable_id' => $timetable_id,
                'timetable_name' => $timetable_name,
                'session_name' => $session_name,
            ]);
            if(empty($timetable_name) || empty($session_name)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }
            if($type==0){
                if ($newTimetable) {
                    try{
                        $courses = Model::all('courses','RAND()');
                        $timetable = Model::getSingle('timetables', 'id', $timetable_id);
                        $staffs = Model::getWhere('users', ['role' => 'staff'], "RAND()",3);
                        $venues = Model::getWhere('venues', ['status' => 'available'], "RAND()", 999);
                        
                        foreach ($courses as $course) {    
                            $matchingVenues = array_filter($venues, function($venue) use ($course) {
                                return $venue->exam_type === $course->exam_type;
                            });
                            
                            if (!empty($matchingVenues)) {  
                                $venue = $matchingVenues[array_rand($matchingVenues)];
                                
                                $invigilators = "";
                                foreach ($staffs as $staff){
                                    $invigilators .= $staff->username." ";
                                }
                                
                                Model::create('generated_timetable', [
                                    'timetable_id' => $timetable_id,
                                    'course_id' => $course->id,
                                    'venue' => $venue->hall_name,
                                    'invigilators' => $invigilators,
                                    'date' => "Not Specify",
                                    'time' => "",
                                ]);
                                
                            }
                            
                        }
                    } catch (\Exception $e) {
                        response_json(['code' => 500, 'message' => $e->getMessage()]);
                    }
                    response_json(['code' => 200, 'message' => 'TimeTable added successfully']);
                    
                }
            }else{
                if(empty($startDate) || empty($endDate)){
                    response_json(['code' => 400, 'message' => 'Select Dates']);
                } 
    
                $startTimestamp = strtotime($startDate);
                $endTimestamp = strtotime($endDate);
    
                if ($startTimestamp > $endTimestamp) {
                    response_json(['code' => 400, 'message' => 'Start date must be earlier than end date.']);
                } 
                if ($newTimetable) {
                    try{
                        $courses = Model::all('courses','RAND()');
                        $timetable = Model::getSingle('timetables', 'id', $timetable_id);
                        $staffs = Model::getWhere('users', ['role' => 'staff'], "RAND()",3);
                        $venues = Model::getWhere('venues', ['status' => 'available'], "RAND()", 999);
                        $examTimes = array("9:00am","8:30am","12:00pm","3:00pm");
    
                        
                        foreach ($courses as $course) {    
                            $matchingVenues = array_filter($venues, function($venue) use ($course) {
                                return $venue->exam_type === $course->exam_type;
                            });
                            
                            if (!empty($matchingVenues)) {   
                                $randomTimestamp = rand($startTimestamp, $endTimestamp);  
                                $randomDate = date('d M, Y', $randomTimestamp);
                                // $randomDate = date('d M, Y', strtotime('+' . rand(0, 30) . ' days'));
                                $venue = $matchingVenues[array_rand($matchingVenues)];
                                $examTime = $examTimes[array_rand($examTimes)];
                                
                                $invigilators = "";
                                foreach ($staffs as $staff){
                                    $invigilators .= $staff->name." ";
                                }
                                
                                // Combine date and time for exam datetime
                                $examDateTime = $examTime . ' ' . $randomDate;  
                                
                                Model::create('generated_timetable', [
                                    'timetable_id' => $timetable_id,
                                    'course_id' => $course->id,
                                    'venue' => $venue->hall_name,
                                    'invigilators' => $invigilators,
                                    'date' => $randomDate,
                                    'time' => $examTime,
                                ]);
                                
                            }
                            
                        }
                    } catch (\Exception $e) {
                        response_json(['code' => 500, 'message' => $e->getMessage()]);
                    }
                    response_json(['code' => 200, 'message' => 'TimeTable added successfully']);
                    
                }
            }
            
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add TimeTable";
           
            return view('admin/add-timetable', compact('title'));
        }
    }
    public static function editTimeTable(Request $request, $args)
    {
        if($request->isPost()){
            $timetable_name = $request->input('timetable_name');
            //session_name
            $session_name = $request->input('session_name');
            
            if(empty($timetable_name) || empty($session_name)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }

            $dataQeury = [
                'timetable_name' => $timetable_name,
                'session_name' => $session_name,
            ];
        
            //update the user
            $update = Model::update('timetables', $dataQeury, $args['id']);
            if ($update) {
                response_json(['code' => 200, 'message' => 'TimeTable updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
            
        }else{
            $title = "Edit TimeTable";
            $id = $args['id'];
            $timetable = Model::getSingle('timetables', 'id', $args['id']);
            return view('admin/edit-timetable', compact('title','id','timetable'));
        }
    }
    public static function manageTimeTable(Request $request, $args)
    {
        if($request->isGet()){
            $title = "Manage TimeTable";
            $id = $args['id'];
            $timetable = Model::getSingle('timetables', 'id', $args['id']);
            $generated_timetable_list = Model::getWhere('generated_timetable', ['timetable_id' => $timetable->timetable_id], "date ASC", 999);
            
            return view('admin/manage-timetable', compact('title','id','timetable','generated_timetable_list'));
        }
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
    public static function editTimeTableCourse(Request $request, $args)
    {
        if($request->isPost()){
            $course_name = $request->input('course_name');
            $course_code = $request->input('course_code');
            $venue = $request->input('venue');
            $invigilators = $request->input('invigilators');
            $notification = $request->input('notification');
            $date = $request->input('date');
           
            if(empty($venue) || empty($invigilators) || empty($date)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }

            $dataQeury = [
                'venue' => $venue,
                'invigilators' => $invigilators,
                'date' => $date,
            ];
        
            //update the user
            $update = Model::update('generated_timetable', $dataQeury, $args['id']);
            if ($update) {
                if($notification==1){
                    Model::create('notifications', [
                        'message' => "Timetable Updated ".$course_name."(".$course_code.") will take place on ".$date.", invigilators include: ".$invigilators,
                    ]);
                }
                response_json(['code' => 200, 'message' => 'Updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
           
        }else{
            $title = "Edit TimeTable Course";
            $id = $args['id'];
            $generated_timetable = Model::getSingle('generated_timetable', 'id', $args['id']);
            return view('admin/edit-timetable-course', compact('title','id','generated_timetable'));
        }
    }
    public static function courses(Request $request)
    {
        $title = "Courses";
        $courses = Model::all('courses','id DESC',999);
        //view
        return view('admin/courses', compact('title', 'courses'));
    }
    public static function addCourse(Request $request)
    {
        if($request->isPost()){
            $course_name = $request->input('course_name');
            $course_code = $request->input('course_code');
            $exam_type = $request->input('exam_type');
            // $no_of_student = $request->input('no_of_student');
            $level = $request->input('level');
            
            if(empty($course_name) || empty($course_code) || empty($exam_type) || empty($level)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }

            $newCourse = Model::create('courses', [
                'course_name' => $course_name,
                'course_code' => $course_code,
                // 'no_of_student' => $no_of_student,
                'level' => $level,
                'exam_type' => $exam_type,
            ]);
            if ($newCourse) {
                response_json(['code' => 200, 'message' => 'Course added successful']);
            }
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add Course";
            $users = Model::all('timetables');
            //view
            return view('admin/add-course', compact('title', 'users'));
        }
    }
    public static function editCourse(Request $request, $args)
    {
        if($request->isPost()){
            $course_name = $request->input('course_name');
            $course_code = $request->input('course_code');
            $exam_type = $request->input('exam_type');
            // $no_of_student = $request->input('no_of_student');
            $level = $request->input('level');
            
            if(empty($course_name) || empty($course_code) || empty($exam_type) || empty($level)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }

            $dataQeury = [
                'course_name' => $course_name,
                'course_code' => $course_code,
                // 'no_of_student' => $no_of_student,
                'level' => $level,
                'exam_type' => $exam_type,
            ];
        
            //update the user
            $update = Model::update('courses', $dataQeury, $args['id']);
            if ($update) {
                response_json(['code' => 200, 'message' => 'Course updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
           
        }else{
            $title = "Edit Course";
            $id = $args['id'];
            $course = Model::getSingle('courses', 'id', $args['id']);
            return view('admin/edit-course', compact('title','id','course'));
        }
    }
    public static function reports(Request $request)
    {
        $title = "Reports";
        
        //get recent transactions limit 5
        $reports = Model::all('reports','id DESC',999);
        return view('admin/reports', ["title" => $title, 'reports' => $reports]);
    }
    public static function addReply(Request $request,$args)
    {
        if($request->isPost()){
            $reply = $request->input('reply');
            
            if(empty($reply)){
                response_json(['code' => 400, 'message' => 'Reply is required']);
            }

            $update = Model::update('reports',['reply'=>$reply],$args['id']);
            
            if ($update) {
                response_json(['code' => 200, 'message' => 'Reply sent successful']);
            }
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add Reply";
            $id = $args['id'];
            $report = Model::getSingle('reports', 'id', $args['id']);
            //view
            return view('admin/add-reply', compact('title','id','report'));
        }
    }
    public static function notifications(Request $request)
    {
        $title = "Notifications";
        
        //get recent transactions limit 5
        $notifications = Model::all('notifications','id DESC',999);
        return view('admin/notifications', ["title" => $title, 'notifications' => $notifications]);
    }
    public static function addNotification(Request $request)
    {
        if($request->isPost()){
            $notification = $request->input('notification');
            
            if(empty($notification)){
                response_json(['code' => 400, 'message' => 'Notification is required']);
            }

            $create = Model::create('notifications',[
                 'message'=>$notification
            ]);
            
            if ($create) {
                response_json(['code' => 200, 'message' => 'Notification sent successful']);
            }
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add Notification";
            //view
            return view('admin/add-notification', compact('title'));
        }
    }
    public static function staffs(Request $request)
    {
        $title = "Staffs";
        $staffs = Model::getWhere('users', ['role' => 'staff'], "id DESC", 999);
        //view
        return view('admin/staffs', compact('title', 'staffs'));
    }
    public static function addStaff(Request $request)
    {
        if($request->isPost()){
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
            //check if admission number already exists
            $user = Model::getSingle('users', 'username', $username);
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
                'username' => $username,
                'rank' => $rank,
                'role' => 'staff',
                'password' => $password
            ]);
            if ($newUser) {
                response_json(['code' => 200, 'message' => 'Staff Added successful']);
            }
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add Staff";
            $users = Model::all('timetables');
            //view
            return view('admin/add-staff', compact('title', 'users'));
        }
    }
    public static function editStaff(Request $request, $args)
    {
        if($request->isPost()){
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
            $update = Model::update('users', $dataQeury, $args['id']);
            if ($update) {
                response_json(['code' => 200, 'message' => 'Staff updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
           
        }else{
            $title = "Edit Staff";
            $id = $args['id'];
            $staff = Model::getSingle('users', 'id', $args['id']);
            return view('admin/edit-staff', compact('title','id','staff'));
        }
    }
    public static function students(Request $request)
    {
        $title = "Students";
        $students = Model::getWhere('users', ['role' => 'student'], "id DESC",999);
        //view
        return view('admin/students', compact('title', 'students'));
    }
    public static function addStudent(Request $request)
    {
        if($request->isPost()){
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
                response_json(['code' => 200, 'message' => 'Registration successful']);
            }
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add Student";
            $users = Model::all('timetables');
            //view
            return view('admin/add-student', compact('title', 'users'));
        }
    }
    public static function editStudent(Request $request, $args)
    {
        if($request->isPost()){
            $name = $request->input('name');
            //email
            $email = $request->input('email');
            //admission_number
            $admission_number = $request->input('admission_number');
            //password
            $password = $request->input('password');
            if(empty($name) || empty($email) || empty($admission_number) || empty($level) || empty($password)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }
            
            //hash password
            //$password = password_hash($password, PASSWORD_DEFAULT);
            //insert into database
            $dataQeury = [
                'name' => $name,
                'email' => $email,
                'username' => $admission_number,
                'role' => 'student',
                'password' => $password
            ];
        
            //update the user
            $update = Model::update('users', $dataQeury, $args['id']);
            if ($update) {
                response_json(['code' => 200, 'message' => 'Student updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
           
        }else{
            $title = "Edit Student";
            $id = $args['id'];
            $student = Model::getSingle('users', 'id', $args['id']);
            return view('admin/edit-student', compact('title','id','student'));
        }
    }
    public static function venues(Request $request)
    {
        $title = "Venues";
        $venues = Model::all('venues','id DESC',999);
        //view
        return view('admin/venues', compact('title', 'venues'));
    }
    public static function addVenue(Request $request)
    {
        if($request->isPost()){
            $hall_name = $request->input('hall_name');
            $exam_type = $request->input('exam_type');
            //$no_of_seats = $request->input('no_of_seats');
            
            if(empty($hall_name) || empty($exam_type)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }

            $newCourse = Model::create('venues', [
                'hall_name' => $hall_name,
                //'no_of_seats' => $no_of_seats,
                'exam_type' => $exam_type,
            ]);
            if ($newCourse) {
                response_json(['code' => 200, 'message' => 'Venue added successful']);
            }
            //if something goes wrong
            response_json(['code' => 500, 'message' => 'Something went wrong']);
        }else{
            $title = "Add Venue";
            $users = Model::all('timetables');
            //view
            return view('admin/add-venue', compact('title', 'users'));
        }
    }
    public static function editVenue(Request $request,$args)
    {
        if($request->isPost()){
            $hall_name = $request->input('hall_name');
            $exam_type = $request->input('exam_type');
            //$no_of_seats = $request->input('no_of_seats');
            
            if(empty($hall_name) || empty($exam_type)){
                response_json(['code' => 400, 'message' => 'All Input are required']);
            }

            $dataQeury = [
                'hall_name' => $hall_name,
                //'no_of_seats' => $no_of_seats,
                'exam_type' => $exam_type,
            ];
        
            //update the user
            $update = Model::update('venues', $dataQeury, $args['id']);
            if ($update) {
                response_json(['code' => 200, 'message' => 'Venue updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
           
        }else{
            $title = "Edit Venue";
            $id = $args['id'];
            $venue = Model::getSingle('venues', 'id', $args['id']);
            return view('admin/edit-venue', compact('title','id','venue'));
        }
    }
    public static function profile(Request $request)
    {
        if($request->isPost()){
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
                'role' => 'admin',
                'password' => $password
            ];
        
            //update the user
            $update = Model::update('users', $dataQeury, auth()->getId());
            if ($update) {
                response_json(['code' => 200, 'message' => 'Profile updated successfully']);
            } else {
                response_json(['code' => 500, 'message' => 'Something went wrong']);
            }
           
        }else{
            $title = "Profile";
            $user = Model::getSingle('users', 'id', auth()->getId());
            return view('admin/profile', compact('title','user'));
        }
    }
}