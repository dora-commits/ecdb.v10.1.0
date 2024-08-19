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
        AdminAuthMiddleware::setUsername($data);
        
        // Proceed with other logic for the dashboard
        $this->view('admin/dashboard', $data);
    }

    public function login(){
        // Call the middleware for login section
        AdminAuthMiddleware::handle(); 
    }

    public function logout(){

    }

    public function signup(){

    }
}


