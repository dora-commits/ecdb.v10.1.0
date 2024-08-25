<!-- Main -->

<main class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->

        <div class="d-flex align-items-center gap-2">
            <a class="nav-link d-flex align-items-center gap-2"
                href="<?= $_ENV['ROOT'] ?>/admin/dashboard"
                style="font-weight: bold; font-size: 1.1rem; color: #007bff; transition: all 0.3s ease;">

                <svg class="bi" width="24" height="24" fill="currentColor" style="transition: transform 0.3s ease;">
                    <use xlink:href="#house-fill" />
                </svg>
                <span>Dashboard</span>
            </a>
            <span style="font-size: 1.2rem; color: #007bff;">&#9679;</span> <!-- This is a dot icon -->
            <a class="nav-link d-flex align-items-center gap-2"
                href="<?= $_ENV['ROOT'] ?>/admin/settings"
                style="font-weight: bold; font-size: 1.1rem; color: #007bff; transition: all 0.3s ease;">

                <svg class="bi" width="24" height="24" fill="currentColor" style="transition: transform 0.3s ease;">
                    <use xlink:href="#gear-wide-connected" />
                </svg>
                <span>Settings</span>
            </a>
        </div>

        <style>
            .nav-link:hover {
                color: #0056b3;
                text-decoration: none;
            }

            .nav-link:hover svg {
                transform: scale(1.2);
                fill: #0056b3;
            }

            .nav-link span {
                display: inline-block;
                transition: transform 0.3s ease;
            }

            .nav-link:hover span {
                transform: translateX(5px);
            }
        </style>
    </div>

    <!-- Disable Card transform effect and sth-->
    <style>
        .card:hover {
            transform: none !important;
        }

        .card-body {
            padding: 20px;
            /* Adjust the padding for a spacious layout */
            background-color: #f8f9fa;
            /* Light background color */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card-body h6 {
            font-weight: 600;
            /* Bold font for section titles */
            color: #343a40;
            /* Darker text color */
        }

        .card-body p {
            margin-bottom: 10px;
            /* Space between paragraphs */
            color: #6c757d;
            /* Muted text color for information */
        }

        .card-body:hover {
            transform: translateY(-5px);
            /* Slight lift effect on hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            /* Deeper shadow on hover */
        }

        .icon-frame {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            /* Creates a circular frame */
            background-color: #007bff;
            /* Bootstrap primary color */
            color: white;
            /* Icon color */
            font-size: 16px;
            /* Adjust icon size */
        }

        .icon-frame i {
            font-size: 18px;
            /* Ensure icons are centered and appropriately sized */
        }

        .card-body h6 {
            margin-left: 5px;
            /* Adjust margin for spacing from the frame */
        }
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center align-items-center">
            <!-- Card for displaying user info -->
            <div class="col-md-6">
                <div class="card">
                    <!-- <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0"><kbd>Admin Information</kbd></h5>
                    </div> -->
                    <div class="card-body">
                        <!-- Avatar and Full Name Section -->
                        <div class="d-flex align-items-center mb-4">
                            <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/admin.png" alt="Avatar" class="rounded-circle me-3" style="width: 100px; height: 100px;">
                            <div>
                                <h5 class="mb-0"><?= htmlspecialchars($firstname . ' ' . $lastname); ?></h5>
                                <p class="text-muted"><?= htmlspecialchars($email); ?></p>
                            </div>
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="icon-frame me-2">
                                <i class="bi bi-person"></i>
                            </span>
                            <h6 class="mb-0"><strong>First Name</strong></h6>
                        </div>
                        <p><?= htmlspecialchars($firstname); ?></p>

                        <div class="mb-3 d-flex align-items-center">
                            <span class="icon-frame me-2">
                                <i class="bi bi-person"></i>
                            </span>
                            <h6 class="mb-0"><strong>Last Name</strong></h6>
                        </div>
                        <p><?= htmlspecialchars($lastname); ?></p>

                        <div class="mb-3 d-flex align-items-center">
                            <span class="icon-frame me-2">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <h6 class="mb-0"><strong>Email</strong></h6>
                        </div>
                        <p><?= htmlspecialchars($email); ?></p>

                        <div class="mb-3 d-flex align-items-center">
                            <span class="icon-frame me-2">
                                <i class="bi bi-lock"></i>
                            </span>
                            <h6 class="mb-0"><strong>Password</strong></h6>
                        </div>
                        <p><?= htmlspecialchars($password); ?></p>

                        <div class="mb-3 d-flex align-items-center">
                            <span class="icon-frame me-2">
                                <i class="bi bi-person"></i>
                            </span>
                            <h6><strong>Last Login</strong></h6>
                        </div>
                        <p><?= htmlspecialchars(date('Y-m-d H:i', strtotime($lastlogin))); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>