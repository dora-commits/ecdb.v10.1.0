# ESHOP

![Admin Interface](/public/assets/previews/admin/dashboard.png)

## Table of Contents

- [Description](#description)
- [Key Features](#key-features)
- [Technologies](#technologies)
- [Note](#note)

## Description
Developed a sophisticated e-commerce platform combining PHP for backend operations and ReactJS for the frontend, structured according to the MVC (Model-View-Controller) architecture. The system includes a responsive admin interface, user authentication, comprehensive product and category management, dynamic reporting APIs, and robust security features.

## Key Features

| Feature | Description | Screenshot |
| ------- | ----------- | ---------- |
| **Admin Interface** | - **Responsive Design**: Utilizes CSS Flexbox and Grid for a responsive layout.<br>- **Theme Toggle**: Allows switching between light and dark themes. | ![Admin Interface](/public/assets/previews/admin/dashboard.png) |
| **Authentication** | - **Login**: Admin login with database validation and session management.<br>- **Signup**: Includes regex validation for names, `filter_var` for email format, and terms acceptance. | ![Login Page](/public/assets/previews/admin/login.png) ![Signup Page](/public/assets/previews/admin/signup.png) |
| **Product, Category, Customer, and Order Management** | - **Product and Category Management**: CRUD operations with image preview and foreign key constraints.<br>- **Timestamp Validation**: Ensures the format and validity of timestamps for user entries. | ![Product Management](/public/assets/previews/admin/products.png) |
| **MVC Architecture** | - **MVC Implementation**: Clear separation of concerns for better maintainability and scalability. | - |
| **API and Reporting** | - **API Development**: APIs for product counts, user spending, and time-series data.<br>- **Charting**: Utilizes Chart.js for data visualization. | ![API Documentation](/public/assets/previews/admin/tree.png) ![Charts](/public/assets/previews/admin/category.png) |
| **Session Handling and Middleware** | - **Session Management**: Manages user data and personalized content display with session and middleware. | - |
| **Data Export** | - **Excel Export**: Exports chart data to Excel (XLSX) format. | ![Excel Export](/public/assets/previews/admin/toggle_theme.png) |
| **Security** | - **Password Encryption**: Uses bcrypt or Argon2 for secure password hashing.<br>- **SQL Injection Protection**: Implements Prepared Statements to prevent SQL Injection.<br>- **XSS and CSRF Protection**: Employs HTML encoding and CSRF tokens for security. | - |

## Technologies
- **Backend**: PHP
- **Frontend**: CSS, JavaScript
- **Database**: MySQL
- **Architecture**: MVC (Model-View-Controller)

## Note
 - Check your **ROOT** carefully in .env
 - Admin Dashboard : **ROOT**/admin

