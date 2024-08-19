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

    public function category()
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->findAll();
        $this->view('admin/category', $data);
    }

    // public function category()
    // {
    //     $data = [];
    //     AdminAuthMiddleware::setUsername($data);
    //     $categoryModel = new CategoryModel();

    //     // Handle ordering
    //     // $orderColumn = isset($_GET['order_column']) ? $_GET['order_column'] : 'name';
    //     // $orderType = isset($_GET['order_type']) ? $_GET['order_type'] : 'asc';

    //     // $validColumns = ['id', 'name'];
    //     // $validTypes = ['asc', 'desc'];

    //     // if (in_array($orderColumn, $validColumns)) {
    //     //     $categoryModel->setOrderColumn($orderColumn);
    //     // }

    //     // if (in_array($orderType, $validTypes)) {
    //     //     $categoryModel->setOrderType($orderType);
    //     // }

    //     // Fetch categories
    //     $data['categories'] = $categoryModel->findAll();
    //     $this->view('admin/category', $data);
    // }

    // Method to handle the creation of a category
    public function category_add()
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name']
            ];

            $categoryModel = new CategoryModel();
            $result = $categoryModel->insert($data);

            if (gettype($result) != "boolean") {
                // Redirect or notify success
                redirect('admin/category');
            } else {
                // Handle error
                $data['error'] = 'Failed to create category.';
                $this->view('admin/category', $data);
            }
        } else {
            // Show the creation form
            $this->view('admin/category_add');
        }
    }

    // Method to handle updating a category
    // public function updateCategory($id)
    // {
    //     $categoryModel = new CategoryModel();

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = [
    //             'name' => $_POST['name']
    //         ];

    //         $result = $categoryModel->update($id, $data);

    //         if ($result) {
    //             // Redirect or notify success
    //             redirect('admin/category');
    //         } else {
    //             // Handle error
    //             $data['errors'] = 'Failed to update category.';
    //             $this->view('admin/category', $data);
    //         }
    //     } else {
    //         // Fetch existing category data
    //         $data['categories'] = $categoryModel->first(['id' => $id]);
    //         $this->view('admin/category', $data);
    //     }
    // }

    public function category_edit($id)
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);
        
        $categoryModel = new CategoryModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize the input data
            $data = [
                'name' => $_POST['name']
            ];

            // Update the category
            $result = $categoryModel->update($id, $data);

            if (gettype($result) != "boolean") {
                // Redirect to the category list after a successful update
                redirect('admin/category');
            } else {
                // TODO: No checked feature
                // If update fails, display the error
                $data['error'] = 'Failed to update category.';
                $data['category'] = $categoryModel->first(['id' => $id]);
                $this->view('admin/category_edit', $data);
            }
        } else {
            // TODO: No checked feature
            // Handle GET request to fetch the existing category data
            $data['category'] = $categoryModel->first(['id' => $id]);
            
            if (!$data['category']) {
                // Handle case where category is not found
                $data['error'] = 'Category not found.';
                $this->view('admin/category', $data);
            } else {
                $this->view('admin/category_edit', $data);
            }
        }
    }


    // Method to handle deleting a category
    public function category_delete($id)
    {
        $categoryModel = new CategoryModel();
        $result = $categoryModel->delete($id);

        if ($result) {
            // Redirect or notify success
            redirect('admin/category');
        } else {
            // Handle error
            $data['error'] = 'Failed to delete category.';
            $this->view('admin/category', $data);
        }
    }
}


