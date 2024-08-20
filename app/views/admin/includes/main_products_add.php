<!-- Main -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2"> Add Products</h1> -->
        <kbd>
            <caption>Add New Products</caption>
        </kbd>
    </div>
    <!-- <h2>Edit Category</h2> -->
    <form action="<?= $_ENV['ROOT'] ?>/admin/products_add" method="post">
        <div class="form-group">
            <label for="name"><strong>Name</strong></label>
            <br>
            <input type="text" name="name" id="name" class="form-control" required>
            <br>

            <label for="catid"><strong>Category ID</strong></label>
            <br>
            <input type="text" name="catid" id="catid" class="form-control" required>
            <br>

            <label for="price"><strong>Price</strong></label>
            <br>
            <input type="text" name="price" id="price" class="form-control" required>
            <br>

            <!-- <label for="thumb"><strong>Thumb</strong></label>
                        <br>
                        <input type="text" name="thumb" id="thumb" class="form-control" value="<?php echo htmlspecialchars($data['products']->thumb); ?>" required>
                        <br> -->
            <label for="thumb"><strong>Thumb</strong></label>
            <br>

            <!-- Display current image -->
            <!-- <?php if (!empty($data['products']->thumb)): ?>
                            <img id="current-thumb" src="<?= $_ENV['ROOT'] ?>/assets/uploads/<?= htmlspecialchars($data['products']->thumb) ?>" alt="Current Thumb" style="max-width: 200px; height: auto;">
                            <br>
                        <?php endif; ?> -->

            <img id="current-thumb"
                src="<?= !empty($data['products']->thumb)
                            ? $_ENV['ROOT'] . '/assets/uploads/' . htmlspecialchars($data['products']->thumb)
                            : $_ENV['ROOT'] . '/assets/uploads/empty.png'; ?>"
                alt="Current Thumb"
                style="max-width: 200px; height: auto;">
            <br>

            <!-- File input to choose a new image -->
            <!-- <input type="file" name="thumb" id="thumb" class="form-control"> -->
            <input type="file" name="thumb" id="thumb" class="form-control" onchange="previewImage(event)">
            <br>

            <script>
                function previewImage(event) {
                    var input = event.target;
                    var file = input.files[0];
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = document.getElementById('current-thumb');
                        img.src = e.target.result;
                        img.style.maxWidth = '200px'; 
                        img.style.height = 'auto';
                    };

                    if (file) {
                        reader.readAsDataURL(file);
                    }
                }
            </script>

            <label for="description"><strong>Description</strong></label>
            <br>
            <!-- <input type="text" name="description" id="description" class="form-control" value="<?php echo htmlspecialchars($data['products']->description); ?>" required> -->
            <textarea name="description" id="description" class="form-control" style="height: 100px;" required></textarea>
            <br>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <p class="text-center mb-0">
            <a class="text-blue d-flex align-items-center align-bottom" href="<?= $_ENV['ROOT'] ?>/admin/products">
                <i class="bi bi-arrow-left-circle me-2 icon-size"> </i>
                Back to List
            </a>
        </p>
    </div>
</main>