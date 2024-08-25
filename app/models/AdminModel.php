<?php

/**
 * class AdminModel
 */
class AdminModel
{
    use Model;

    protected $table = 'admin';
    protected $allowedColumns = [
        'firstname',
        'lastname',
        'email',
        'password'
    ];

    public function validateSignup($data)
    {
        $this->errors = [];

        // Validate firstname
        if (empty($data['firstname'])) {
            $this->errors['firstname'] = "Firstname is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $data['firstname'])) {
            $this->errors['firstname'] = "Firstname can only contain letters and spaces";
        }

        // Validate lastname
        if (empty($data['lastname'])) {
            $this->errors['lastname'] = "Lastname is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $data['lastname'])) {
            $this->errors['lastname'] = "Lastname can only contain letters and spaces";
        }
        
        $admin = new AdminModel();
        $data_check['email'] = $data['email'];;

        // Validate email
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        } elseif ($admin->where($data_check)) {
            $this->errors['email'] = "Email already exists";
        }

        // Validate password
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }

        // Validate terms acceptance
        if (empty($data['terms'])) {
            $this->errors['terms'] = "Please accept terms";
        }

        // Return validation result
        return empty($this->errors);
    }

    public function validateEmailEdit($data)
    {
        $this->errors = [];
        
        $admin = new AdminModel();
        $data_check['email'] = $data['email'];;
        
        // Validate email
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is not valid";
        } elseif ($admin->where($data_check)) {
            $this->errors['email'] = "Email already exists";
        }

        // Return validation result
        return empty($this->errors);
    }
}