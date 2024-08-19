<?php

/**
 *  class Controller
 */
class Controller 
{
    public function view($name, $data = [])
    {
        // Extract data if provided
        if (!empty($data)) {
            extract($data);
        }
    
        // Construct the filename
        $filename = "../app/views/{$name}.view.php";
    
        // Check if the file exists, otherwise load the 404 view
        if (!file_exists($filename)) {
            $filename = "../app/views/404.view.php";
        }
    
        // Load the view file
        require $filename;
    }    
}
