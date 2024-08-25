<?php

// namespace App\Middleware;

/**
 * class AdminAuthMiddleware
 */
class AdminAuthMiddleware
{
    public static function handle()
    {
        if (isset($_SESSION['ADMIN'])) {
            redirect('admin/dashboard');
            exit;
        }
    }
    
    public static function setUsername(&$data)
    {
        $data['username'] = $_SESSION['ADMIN']->firstname . ' ' . $_SESSION['ADMIN']->lastname ?? 'Admin';
        return isset($_SESSION['ADMIN']);
    }

    public static function setInfo(&$data)
    {
        $data['firstname'] = $_SESSION['ADMIN']->firstname;
        $data['lastname'] = $_SESSION['ADMIN']->lastname;
        $data['email'] = $_SESSION['ADMIN']->email;
        $data['password'] = $_SESSION['ADMIN']->password;

        return isset($_SESSION['ADMIN']);
    }

    public static function setLastLogin(&$data)
    {
        $data['lastlogin'] = $_SESSION['ADMIN']->last_login;
        return isset($_SESSION['ADMIN']);
    }
}
