<head>
    <script src="<?= $_ENV['ROOT'] ?>/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">

    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css">

    <link href="<?= $_ENV['ROOT'] ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">

    <link href="<?= $_ENV['ROOT'] ?>/assets/css/sign-in.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }

        /* Admin info */
        /* .admin-info {
            display: flex;
            align-items: center;
        } */

        .admin-avatar {
            width: 40px;
            /* Adjust size as needed */
            height: 40px;
            /* Adjust size as needed */
            border-radius: 50%;
            /* Makes the image circular */
            margin-right: 10px;
            /* Spacing between image and text */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }


        /* SideBar Config  */
        .sidebar {
            position: fixed;
            /* Fix the sidebar position */
            top: 0px;
            /* Align it to the top */
            left: 0;
            /* Align it to the left */
            height: 100vh;
            /* Full viewport height */
            width: 250px;
            /* Adjust width as needed */
            overflow-y: auto;
            /* Allow scrolling within the sidebar if content overflows */
        }

        .main-content {
            margin-left: 250px;
            /* Adjust margin to accommodate the sidebar width */
            padding: 20px;
            /* Add padding to the main content area */
        }

        /* <!-- Custom CSS card dashboard --> */
        .card-img-top-wrapper {
            width: 100%;
            padding-top: 33.33%;
            /* This makes the div take up 1/3 of the card height */
            position: relative;
        }

        .card-img-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the entire area without distorting */
        }

        /* Add this to your CSS file or within a <style> tag */
        .admin-info {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #004085;
            /* Change this to your desired background color */
            color: #ffffff;
            /* Change this to your desired text color */
            border-radius: 5px;
            /* Optional: for rounded corners */
            margin-bottom: 10px;
            /* Adds space below the admin info */
        }

        .admin-avatar {
            width: 50px;
            /* Adjust the size as needed */
            height: 50px;
            /* Adjust the size as needed */
            border-radius: 50%;
            /* Makes the avatar round */
            margin-right: 10px;
        }

        .admin-info strong {
            font-size: 1.2em;
            /* Adjust the font size of the Administrator text */
            color: #ffc107;
            /* Change the color of the "Administrator" text */
        }

        .admin-info i {
            font-style: normal;
            /* Change the font style of the greeting text */
            color: #ffffff;
            /* Change the color of the greeting text */
        }

        .text-white {
            color: #ffffff;
            /* Ensure text is white */
            text-decoration: none;
            /* Remove underline */
        }

        .text-white:hover {
            text-decoration: none;
            /* Ensure underline is still removed on hover */
        }

        .text-blue {
            color: #004085;
            /* Ensure text is white */
            text-decoration: none;
            /* Remove underline */
        }

        .text-blue:hover {
            text-decoration: none;
            /* Ensure underline is still removed on hover */
        }

        /* Css for Info Page */
        .info-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }

        .info-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #007bff;
            margin-bottom: 20px;
        }

        .info-container h1 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .info-container p {
            font-size: 18px;
            color: #333;
        }

        /* Css Sign up */

        /* body {
            background-color: #f8f9fa;
        } */

        .form-signin {
            max-width: 600px;
            margin: auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .form-signin .form-floating>input {
            border-radius: 0.5rem;
        }

        .form-signin .form-floating>label {
            border-radius: 0.5rem;
        }

        .form-signin img {
            max-width: 100px;
            margin-bottom: 1rem;
        }

        .btn-primary {
            border-radius: 0.5rem;
        }

        .text-blue {
            color: #007bff;
        }

        .text-blue:hover {
            text-decoration: underline;
        }

        /* Table, icon */
        .table-responsive {
            margin: 1rem;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table a {
            text-decoration: none;
            color: #007bff;
        }

        .table a:hover {
            text-decoration: underline;
        }

        /* Thumb image */
        .table img.thumb {
            width: 80px;
            /* Adjust the width as needed */
            height: auto;
            /* Maintain aspect ratio */
            object-fit: cover;
            /* Optional: ensures image covers the area */
        }

        /* Icon Back to list */
        .align-bottom {
            display: flex;
            align-items: flex-end;
        }

        .icon-size {
            font-size: 1.25rem;
        }

        /* Footer Css */
        .footer {
            /* background-color: #f8f9fa; */
            /* Light grey background */
            /* top: 50px; */
            padding: 20px;
            border-top: 1px solid #e9ecef;
            /* Light grey border */
            text-align: center;
        }

        .footer .container {
            max-width: 100%;
        }

        .text-muted {
            color: #6c757d !important;
        }

        /* Ensure footer responsiveness */
        @media (max-width: 768px) {
            .footer {
                text-align: center;
                padding: 15px;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= $_ENV['ROOT'] ?>/assets/css/dashboard.css" rel="stylesheet">
</head>