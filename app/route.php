<?php

use App\Controller\AdminController;
use App\Controller\Auth;
use App\Controller\HomeController;
use App\Controller\StudentController;
use App\Controller\StaffController;
use App\Core\Request;
use App\Core\Route;

$route = new Route;

//add middleware redirectIfLoggedIn
$route->middleware('redirectIfLoggedIn', function ($middleware) use ($route) {
    $route::get('/', [HomeController::class, 'login'], $middleware);
    //login
    $route::get('/login', [HomeController::class, 'login'], $middleware);
    //register
    $route::get('/register', [HomeController::class, 'register'], $middleware);
});
//post method

$route::post('/register', [Auth::class, 'register']);
//post method login
$route::post('/login', [Auth::class, 'login']);
//logout
$route::get('/logout', [Auth::class, 'logout']);
$route::get('/zakiyya', function(){echo "Zakiyya";});
//middleware route
$route->middleware('student', function ($middleware) use ($route) {
    //route user
    $route::get('/student', [StudentController::class, 'dashboard'], $middleware);
    //dashboard
    $route::get('/student/dashboard', [StudentController::class, 'dashboard'], $middleware);
    $route::get('/student/timetable/{id}', [StudentController::class, 'timetable'], $middleware);
    $route::get('/student/timetable/manage/print/{id}', [StudentController::class, 'printTimetable'], $middleware);
    //reports
    $route::get('/student/reports', [StudentController::class, 'reports'], $middleware);
    $route::get('/student/reports/add', [StudentController::class, 'addReport'], $middleware);
    $route::post('/student/reports/add', [StudentController::class, 'addReport'], $middleware);
    //Notifications
    $route::get('/student/notifications', [StudentController::class, 'notifications'], $middleware);
    //Profile
    $route::get('/student/profile', [StudentController::class, 'profile'], $middleware);
    $route::post('/student/profile', [StudentController::class, 'profile'], $middleware);
});

//middleware admin
$route->middleware('admin', function ($middleware) use ($route) {
    //route admin
    $route::get('/admin', [AdminController::class, 'index'], $middleware);
    //dashboard
    $route::get('/admin/dashboard', [AdminController::class, 'addTimetable'], $middleware);
    $route::get('/admin/timetable/add', [AdminController::class, 'addTimetable'], $middleware);
    $route::post('/admin/timetable/add', [AdminController::class, 'addTimetable'], $middleware);
    $route::get('/admin/timetable/edit/{id}', [AdminController::class, 'editTimetable'], $middleware);
    $route::get('/admin/timetable/manage/{id}', [AdminController::class, 'manageTimetable'], $middleware);
    $route::get('/admin/timetable/manage/print/{id}', [AdminController::class, 'printTimetable'], $middleware);
    $route::post('/admin/timetable/update/{id}', [AdminController::class, 'editTimetable'], $middleware);
    $route::get('/admin/timetable/course/edit/{id}', [AdminController::class, 'editTimeTableCourse'], $middleware);
    $route::post('/admin/timetable/course/update/{id}', [AdminController::class, 'editTimeTableCourse'], $middleware);
    //course
    $route::get('/admin/courses', [AdminController::class, 'courses'], $middleware);
    $route::get('/admin/courses/add', [AdminController::class, 'addCourse'], $middleware);
    $route::post('/admin/courses/add', [AdminController::class, 'addCourse'], $middleware);
    $route::post('/admin/courses/update/{id}', [AdminController::class, 'editCourse'], $middleware);
    $route::get('/admin/courses/edit/{id}', [AdminController::class, 'editCourse'], $middleware);
    //staff
    $route::get('/admin/staffs', [AdminController::class, 'staffs'], $middleware);
    $route::get('/admin/staffs/add', [AdminController::class, 'addStaff'], $middleware);
    $route::post('/admin/staffs/add', [AdminController::class, 'addStaff'], $middleware);
    $route::get('/admin/staffs/edit/{id}', [AdminController::class, 'editStaff'], $middleware);
    $route::post('/admin/staffs/update/{id}', [AdminController::class, 'editStaff'], $middleware);
    //student
    $route::get('/admin/students', [AdminController::class, 'students'], $middleware);
    $route::get('/admin/students/add', [AdminController::class, 'addStudent'], $middleware);
    $route::post('/admin/students/add', [AdminController::class, 'addStudent'], $middleware);
    $route::post('/admin/students/update/{id}', [AdminController::class, 'editStudent'], $middleware);
    $route::get('/admin/students/edit/{id}', [AdminController::class, 'editStudent'], $middleware);
    //venue
    $route::get('/admin/venues', [AdminController::class, 'venues'], $middleware);
    $route::get('/admin/venues/add', [AdminController::class, 'addVenue'], $middleware);
    $route::post('/admin/venues/add', [AdminController::class, 'addVenue'], $middleware);
    $route::post('/admin/venues/update/{id}', [AdminController::class, 'editVenue'], $middleware);
    $route::get('/admin/venues/edit/{id}', [AdminController::class, 'editVenue'], $middleware);
    //reports
    $route::get('/admin/reports', [AdminController::class, 'reports'], $middleware);
    $route::get('/admin/reports/reply/{id}', [AdminController::class, 'addReply'], $middleware);
    $route::post('/admin/reports/reply/add/{id}', [AdminController::class, 'addReply'], $middleware);
    //notifications
    $route::get('/admin/notifications', [AdminController::class, 'notifications'], $middleware);
    $route::get('/admin/notification/add', [AdminController::class, 'addNotification'], $middleware);
    $route::post('/admin/notification/add', [AdminController::class, 'addNotification'], $middleware);
    //profile
    $route::get('/admin/profile', [AdminController::class, 'profile'], $middleware);
    $route::post('/admin/profile', [AdminController::class, 'profile'], $middleware);
});
$route->middleware('staff', function ($middleware) use ($route) {
    //route admin
    $route::get('/staff', [StaffController::class, 'dashboard'], $middleware);
    //dashboard
    $route::get('/staff/dashboard', [StaffController::class, 'dashboard'], $middleware);
    $route::get('/staff/timetable/{id}', [StaffController::class, 'timetable'], $middleware);
    $route::get('/staff/timetable/manage/print/{id}', [StaffController::class, 'printTimetable'], $middleware);
    //Notifications
    $route::get('/staff/notifications', [StaffController::class, 'notifications'], $middleware);
    //Profile
    $route::get('/staff/profile', [StaffController::class, 'profile'], $middleware);
    $route::post('/staff/profile', [StaffController::class, 'profile'], $middleware);
});

$route::run();