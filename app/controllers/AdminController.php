<?php

/**
 * TODO: can not use namespace while extends other class
 */
// namespace App\Controllers;

// use App\Middleware\AdminAuthMiddleware;

/**
 *  class AdminController
 */
class AdminController extends Controller
{
    public function index(){
        // Initialize data array
        $data = [];
        
        // Set the username using the middleware and display it in view section
        if(AdminAuthMiddleware::setUsername($data)){
            $this->view('admin/dashboard', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function login(){

        // Call the middleware for login section
        AdminAuthMiddleware::handle(); 

        // Initialize data array with a default username
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $admin = new AdminModel;

            // Get the email from the POST request
            $email = $_POST['email'] ?? '';

            // Attempt to find the admin by email
            $row = $admin->first(['email' => $email]);

            if ($row && $row->password === $_POST['password']) {
                // Set the session and redirect if credentials are correct
                $_SESSION['ADMIN'] = $row;
                redirect('admin/dashboard');
                exit;
            }

            // Set error message if login fails
            $data['errors']['email'] = "Wrong email or password";
        }

        // Load the login view with the data array
        $this->view('admin/login', $data);
    }

    public function logout(){
        if(!empty($_SESSION['ADMIN']))
            unset($_SESSION['ADMIN']);
        redirect('admin/login');
    }

    public function signup()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $admin =  new AdminModel;
            if ($admin->validateSignup($_POST))
            {
                $admin->insert($_POST);
                redirect('admin/dashboard');
            }
    
            $data['errors'] = $admin->errors;
        }
        $this->view('admin/signup', $data);
    }
}


