# ESHOP (Admin Dashboard version)

![Admin Interface](/public/assets/previews/admin/dashboard.png)

## Table of Contents

- [Description](#description)
- [Key Features](#key-features)
- [Technologies](#technologies)
- [Note](#note)

## Description
Developed a e-commerce platform for managing various product categories such as books, mobiles, and cameras, utilizing a custom implementation of the MVC (Model-View-Controller) architecture. The platform features a modern, user-friendly interface for customers and a comprehensive management system for administrators. 

## Key Features

| Feature | Description | Screenshot |
| ------- | ----------- | ---------- |
| **Admin Interface** | Created an efficient administrative interface using **PHP**. Included features for managing products, categories, and orders with a clean, functional layout that includes a sidebar, main content area, and footer for ease of use. Ensured real-time updates and an intuitive navigation system.<br> **Theme Toggle**: Allows switching between light and dark themes. | ![Admin Interface](/public/assets/previews/admin/dashboard.png) ![Admin Interface](/public/assets/previews/admin/toggle-dark.png) |
| **Authentication** | **Login**: Admin login with database validation and session management.<br> **Signup**: Includes regex validation for names, `filter_var` for email format, and terms acceptance. | ![Login Page](/public/assets/previews/admin/login.png) ![Signup Page](/public/assets/previews/admin/signup.png) |
| **Product, Category, Customer, and Order Management** | **Product and Category Management**: CRUD operations with image preview and foreign key constraints.<br> **Timestamp Validation**: Ensures the format and validity of timestamps for user entries. | ![Product Management](/public/assets/previews/admin/products.png) ![Product Management](/public/assets/previews/admin/user_list.png) |
| **MVC Architecture** | **MVC Implementation**: Clear separation of concerns for better maintainability and scalability. | - |
| **API and Reporting** | **API Development**: APIs for product counts, user spending, and time-series data.<br> **Charting**: Utilizes Chart.js for data visualization. | ![API Documentation](/public/assets/previews/admin/category_add_items.png) ![Charts](/public/assets/previews/admin/category.png) ![Charts](/public/assets/previews/admin/products_1.png) ![Charts](/public/assets/previews/admin/settings.png) |
| **Data Export** | Enabled data export functionality to Excel, allowing administrators to easily access and analyze chart data.. | ![Excel Export](/public/assets/previews/admin/reports.png) |
| **Security, Session and Middleware** | Applied comprehensive security practices, including password hashing, SQL injection prevention, and protection against XSS/CSRF attacks to ensure application security and data integrity. Utilized PHP session management and middleware to dynamically handle user-specific data, enhancing the flexibility and functionality of the admin interface. | - |

## Technologies
- **Backend**: PHP (*requirement of this project*: *non-framework*)
- **Frontend**: CSS, JavaScript
- **Database**: MySQL
- **Architecture**: MVC (Model-View-Controller)

## Note
 - Check your **ROOT** carefully in .env
 - Admin Dashboard : **ROOT**/admin

