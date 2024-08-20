<!-- Main -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/category" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#people" />
            </svg>
            Customers
        </a>

        <!--  -->
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
    </div>
    <!-- <h2>Categories</h2> -->
    <!-- Display the error message if it exists -->
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($data['error']); ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive small">
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <caption>List of Users</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center;">No.</th>
                    <th scope="col" style="text-align: center;">Email</th>
                    <th scope="col" style="text-align: center;">Password</th>
                    <th scope="col" style="text-align: center;">Timestamp</th>
                    <th scope="col" style="text-align: center; width: 150px;">Edit</th>
                    <th scope="col" style="text-align: center; width: 150px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($user->password, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($user->timestamp, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/users_edit/<?php echo htmlspecialchars($user->id); ?>" class="text-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/users_delete/<?php echo htmlspecialchars($user->id); ?>" onclick="return confirm('Are you sure?');" class="text-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    </div>
</main>