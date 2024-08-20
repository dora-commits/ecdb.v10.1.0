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

        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();
        $userModel = new UserModel();

        $data['count_products'] = $productModel->countAll();
        $data['count_category'] = $categoryModel->countAll();
        $data['count_users'] = $userModel->countAll();

        
        // // Fetch other necessary data and then load the view
        // $this->view('admin/dashboard', $data);
        
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
            $this->view('admin/category_add', $data);
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
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        $categoryModel = new CategoryModel();

        // Check if the category has references
        if ($categoryModel->hasReferences($id)) {
            $category = $categoryModel->where(['id'=> $id]);

            $name_category = $category[0]->{"name"};

            $data['error'] = "Cannot delete category: {$name_category}. It is referenced by products.";
            // redirect('admin/category', $data);
            $this->view('admin/category', $data);
            return;
        }

        $result = $categoryModel->delete($id);

        if (gettype($result) != "boolean") {
            // Redirect or notify success
            redirect('admin/category');
        } else {
            // Handle error
            $data['error'] = 'Failed to delete category.';
            $this->view('admin/category', $data);
        }
    }

    public function products()
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll_products();
        $this->view('admin/products', $data);
    }

    public function products_add()
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'catid' => $_POST['catid'],
                'price' => $_POST['price'],
                'thumb' => $_POST['thumb'],
                'description' => $_POST['description']
            ];

            $productModel = new ProductModel();
            $result = $productModel->insert($data);

            if (gettype($result) != "boolean") {
                // Redirect or notify success
                redirect('admin/products');
            } else {
                // Handle error
                $data['error'] = 'Failed to create product.';
                $this->view('admin/products', $data);
            }
        } else {
            // Show the creation form
            $this->view('admin/products_add', $data);
        }
    }

    public function products_edit($id)
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        $productModel = new ProductModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize the input data
            $data = [
                'name' => $_POST['name'],
                'catid' => $_POST['catid'],
                'price' => $_POST['price'],
                'thumb' => $_POST['thumb'],
                'description' => $_POST['description']
            ];

            // Update the product
            $result = $productModel->update($id, $data);

            if (gettype($result) != "boolean") {
                // Redirect to the product list after a successful update
                redirect('admin/products');
            } else {
                // TODO: No checked feature
                // If update fails, display the error
                $data['error'] = 'Failed to update product.';
                $data['products'] = $productModel->first(['id' => $id]);
                $this->view('admin/products_edit', $data);
            }
        } else {
            // TODO: No checked feature
            // Handle GET request to fetch the existing product data
            $data['products'] = $productModel->first(['id' => $id]);
            
            if (!$data['products']) {
                // Handle case where product is not found
                $data['error'] = 'Product not found.';
                $this->view('admin/products', $data);
            } else {
                $this->view('admin/products_edit', $data);
            }
        }
    }

    public function products_delete($id){
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        $productModel = new ProductModel();

        // Check if the product has references
        if ($productModel->hasReferences($id)) {
            $product = $productModel->where(['id'=> $id]);

            $name_product = $product[0]->{"name"};

            $data['error'] = "Cannot delete product: {$name_product}. It is referenced by orderitem.";
            // redirect('admin/category', $data);
            $this->view('admin/products', $data);
            return;
        }

        $result = $productModel->delete($id);

        if (gettype($result) != "boolean") {
            // Redirect or notify success
            redirect('admin/products');
        } else {
            // Handle error
            $data['error'] = 'Failed to delete product.';
            $this->view('admin/products', $data);
        }
    }

    public function users()
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        $this->view('admin/users', $data);
    }

    public function users_edit($id)
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        $userModel = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize the input data
            
            // $timestamp = $_POST['timestamp'];
            // $formattedTimestamp = date('Y-m-d H:i:s', strtotime($timestamp));

            $timestamp = $_POST['timestamp'];

            // Check if the timestamp is valid
            if (strtotime($timestamp) !== false) {
                $formattedTimestamp = date('Y-m-d H:i:s', strtotime($timestamp));
            } else {
                $data['error'] = 'Invalid timestamp.';
                $data['users'] = $userModel->first(['id' => $id]);
                $this->view('admin/users_edit', $data);
                return;
            }

            $data = [
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'timestamp' => $formattedTimestamp,
            ];

            // Update the user
            $result = $userModel->update($id, $data);

            if (gettype($result) != "boolean") {
                // Redirect to the user list after a successful update
                redirect('admin/users');
            } else {
                // TODO: No checked feature
                // If update fails, display the error
                $data['error'] = 'Failed to update user.';
                $data['users'] = $userModel->first(['id' => $id]);
                $this->view('admin/users_edit', $data);
            }
        } else {
            // TODO: No checked feature
            // Handle GET request to fetch the existing user data
            $data['users'] = $userModel->first(['id' => $id]);
            
            if (!$data['users']) {
                // Handle case where user is not found
                $data['error'] = 'User not found.';
                $this->view('admin/users', $data);
            } else {
                $this->view('admin/users_edit', $data);
            }
        }
    }

    public function users_delete($id)
    {
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        $userModel = new UserModel();

        // Check if the category has references
        if ($userModel->hasReferences($id)) {
            $users = $userModel->where(['id'=> $id]);

            $email_user = $users[0]->{"email"};

            $data['error'] = "Cannot delete user: {$email_user}. It is referenced by other table.";

            $this->view('admin/users', $data);
            return;
        }

        $result = $userModel->delete($id);

        if (gettype($result) != "boolean") {
            // Redirect or notify success
            redirect('admin/users');
        } else {
            // Handle error
            $data['error'] = 'Failed to delete user.';
            $this->view('admin/users', $data);
        }
    }

    public function info(){
        // Initialize data array
        $data = [];
        AdminAuthMiddleware::setUsername($data);

        $this->view('admin/info', $data);
    }
}


