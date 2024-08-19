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
        $data['username'] = $_SESSION['ADMIN']->admin_name ?? 'Admin';
    }
}
