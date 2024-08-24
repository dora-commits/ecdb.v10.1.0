<!-- Header -->
<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <!-- Search functionality for small screens -->
    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
                <svg class="bi">
                    <use xlink:href="#search" />
                </svg>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <svg class="bi">
                    <use xlink:href="#list" />
                </svg>
            </button>
        </li>
    </ul>

    <!-- Modern Search Bar for larger screens -->
    <!-- <div id="navbarSearch" class="navbar-search flex-grow-1">
        <input class="form-control w-100 rounded-0 border-0 bg-light" type="text" placeholder="Search" aria-label="Search">
    </div> -->

    <!-- Dropdown List (User Menu) -->
    <ul class="navbar-nav px-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg class="bi me-2" width="24" height="24" fill="currentColor">
                    <!-- <use xlink:href="#person-circle" /> -->
                    <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/admin.png" alt="Admin Avatar" class="admin-avatar">
                </svg>
                User
            </a>
            <!-- <a class="text-white" href="<?= $_ENV['ROOT'] ?>/admin/info">
                <div class="admin-info">
                    <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/admin.png" alt="Admin Avatar" class="admin-avatar">
                    <div>
                        <strong>Administrator</strong> <br> <i>Hi, <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></i>
                    </div>
                </div>
            </a> -->
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Notifications</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </li>
    </ul>
</header>