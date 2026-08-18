<?php
//check if function exists
if (!function_exists('view')) {
    //view
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function view($view, $args = [])
    {
        return \App\Core\View::render($view, $args);
    }
}

//ade_include
//check if function exists
if (!function_exists('ade_include')) {
    //ade_include
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function ade_include($view, $args = [])
    {
        echo \App\Core\View::include($view, $args);
    }
}

//extend
//check if function exists
if (!function_exists('extend')) {
    //extend
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function extend($view, $sction = null, $args = [])
    {
        echo \App\Core\View::extend($view, $sction, $args);
    }
}
//section
//check if function exists
if (!function_exists('site_name')) {
    //section
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function site_name()
    {
        echo "Exam TimeTable Management System";
    }
}
//section
//check if function exists
if (!function_exists('section')) {
    //section
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function section($section)
    {
        echo \App\Core\View::section($section);
    }
}

//endsection
//check if function exists
if (!function_exists('endsection')) {
    //endsection
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function endsection()
    {
        return \App\Core\View::endsection();
    }
}

//ade_yield
//check if function exists
if (!function_exists('ade_yield')) {
    //ade_yield
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function ade_yield($section)
    {
        echo \App\Core\View::yield($section);
    }
}

//pushScript
//check if function exists
if (!function_exists('pushScript')) {
    //pushScript
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function pushScript($section)
    {
        echo \App\Core\View::pushScript($section);
    }
}

//endPushScript
//check if function exists
if (!function_exists('endPushScript')) {
    //endPushScript
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function endPushScript()
    {
        return \App\Core\View::endPushScript();
    }
}

//esc_url
//check if function exists
if (!function_exists('esc_url')) {
    //esc_url
    /*
    * @param string $url
    * @return string
    */
    function esc_url($url)
    {
        return \App\Core\Component::esc_url($url);
    }
}

//App\Core\Route::redirect
//check if function exists
if (!function_exists('redirect')) {
    //redirect
    /*
    * @param string $url
    * @return string
    */
    function redirect($url, $args = [])
    {
        return \App\Core\Route::redirect($url, $args);
    }
}

//baseurl
//check if function exists
if (!function_exists('baseurl')) {
    //baseurl
    /*
    * @return string
    */
    function baseurl()
    {
        return \App\Core\Request::baseurl();
    }
}

//assets
//check if function exists
if (!function_exists('assets')) {
    //assets
    /*
    * @param string $path
    * @return string
    */
    function assets($path)
    {
        return \App\Core\Component::assets($path);
    }
}

//url
//check if function exists
if (!function_exists('url')) {
    //url
    /*
    * @param string $path
    * @return string
    */
    function url($path)
    {
        return \App\Core\Component::url($path);
    }
}

//response_json
//check if function exists
if (!function_exists('response_json')) {
    //response_json
    /*
    * @param array $array
    * @return json
    */
    function response_json($array)
    {
        return \App\Core\Component::response_json($array);
    }
}

//cleanPhone
//check if function exists
if (!function_exists('cleanPhone')) {
    //cleanPhone
    /*
    * @param string $phone
    * @return string
    */
    function cleanPhone($phone)
    {
        return \App\Core\Component::cleanPhone($phone);
    }
}

//auth
//check if function exists
if (!function_exists('auth')) {
    //auth
    /*
    * @return object
    */
    function auth()
    {
        $auth = new \App\Core\Authentication();
        return $auth->instance();
    }
}

//App\Core\Mailer::sendEmail
//check if function exists
if (!function_exists('sendEmail')) {
    //sendEmail
    /*
    * @param string $to
    * @param string $subject
    * @param string $message
    * @return boolean
    */
    function sendEmail($to, $name, $subject, $message)
    {
        return \App\Core\Mailer::sendEmail($to, $name, $subject, $message);
    }
}

//returnRender
//check if function exists
if (!function_exists('returnRender')) {
    //returnRender
    /*
    * @param string $view
    * @param array $args
    * @return html
    */
    function returnRender($view, $args = [])
    {
        return \App\Core\View::returnRender($view, $args);
    }
}

//get single user
if (!function_exists('getUser')) {
    //getUser
    /*
    * @param string $id
    * @return object
    */
    function getUser($id)
    {
        return \App\Core\Model::getSingle('users', 'id', $id);
    }
}
//get single user
if (!function_exists('getCourse')) {
    //getUser
    /*
    * @param string $id
    * @return object
    */
    function getCourse($id)
    {
        return \App\Core\Model::getSingle('courses', 'id', $id);
    }
}
