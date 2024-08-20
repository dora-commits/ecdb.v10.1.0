<!-- Main  -->

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
        <kbd>
            <caption>Update Category</caption>
        </kbd>
    </div>

    <form action="<?= $_ENV['ROOT'] ?>/admin/category_edit/<?php echo htmlspecialchars($data['category']->id); ?>" method="post">
        <div class="form-group">
            <label for="name"><strong>Name</strong></label>
            <br>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($data['category']->name); ?>" required>
            <br>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a href="<?= $_ENV['ROOT'] ?>/admin/category">Back to List</a>
    </div> -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <p class="text-center mb-0">
            <a class="text-blue d-flex align-items-center align-bottom" href="<?= $_ENV['ROOT'] ?>/admin/category">
                <i class="bi bi-arrow-left-circle me-2 icon-size"> </i>
                Back to List
            </a>
        </p>
    </div>

</main>