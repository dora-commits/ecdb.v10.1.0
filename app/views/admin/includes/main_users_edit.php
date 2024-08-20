<!-- Main -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/users" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#people" />
            </svg>
            Users
        </a>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi">
                    <use xlink:href="#calendar3" />
                </svg>
                This week
            </button>
        </div>
    </div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="215"></canvas>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Categories</h1> -->
        <kbd>
            <caption>Update User</caption>
        </kbd>
    </div>

    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($data['error'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <!-- <h2>Edit Category</h2> -->
    <form action="<?= $_ENV['ROOT'] ?>/admin/users_edit/<?php echo htmlspecialchars($data['users']->id); ?>" method="post">
        <div class="form-group">
            <label for="email"><strong>Email</strong></label>
            <br>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($data['users']->email); ?>" required>
            <br>

            <label for="password"><strong>Password</strong></label>
            <br>
            <input type="text" name="password" id="password" class="form-control" value="<?php echo htmlspecialchars($data['users']->password); ?>" required>
            <br>
            <!-- Timestamp :)))) -->
            <label for="timestamp"><strong>Timestamp</strong></label>
            <br>
            <!-- TODO: Make Invalid Timestamp by change type type="datetime-local" to type="text" and write sth wrong time-->
            <input type="datetime-local" name="timestamp" id="timestamp" class="form-control" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($data['users']->timestamp))); ?>" required>
            <br>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a href="<?= $_ENV['ROOT'] ?>/admin/users">Back to List</a>
    </div> -->

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <p class="text-center mb-0">
            <a class="text-blue d-flex align-items-center align-bottom" href="<?= $_ENV['ROOT'] ?>/admin/users">
                <i class="bi bi-arrow-left-circle me-2 icon-size"> </i>
                Back to List
            </a>
        </p>
    </div>
</main>