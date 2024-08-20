<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/category" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#cart" />
            </svg>
            Category
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

    <canvas class="my-4 w-100" id="myChart" width="900" height="250"></canvas>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!--  -->
    </div>
    <!-- Display the error message if it exists -->
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($data['error']); ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive small">
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <caption>List of Categories</caption>
            <thead class="table-dark">
                <!-- <thead class="table-light"> -->
                <tr>
                    <th scope="col" style="text-align: center;">No.</th>
                    <th scope="col" style="text-align: center;">Name</th>
                    <th scope="col" style="text-align: center;">Edit</th>
                    <th scope="col" style="text-align: center;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><a href="<?= $_ENV['ROOT'] ?>/admin/category_edit/<?php echo htmlspecialchars($category->id); ?>">Edit</a> </td>
                            <td style="text-align: center;"><a href="<?= $_ENV['ROOT'] ?>/admin/category_delete/<?php echo htmlspecialchars($category->id); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No categories found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a href="<?= $_ENV['ROOT'] ?>/admin/category_add" class="btn btn-primary">Add new category</a>
    </div>
</main>