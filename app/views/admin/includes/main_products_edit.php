<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Edit Products</h1> -->
        <kbd>
            <caption>Update Product</caption>
        </kbd>
    </div>
    <!-- <h2>Edit Category</h2> -->
    <form action="<?= $_ENV['ROOT'] ?>/admin/products_edit/<?php echo htmlspecialchars($data['products']->id); ?>" method="post">
        <div class="form-group">
            <label for="name"><strong>Name</strong></label>
            <br>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($data['products']->name); ?>" required>
            <br>

            <label for="catid"><strong>Category ID</strong></label>
            <br>
            <input type="text" name="catid" id="catid" class="form-control" value="<?php echo htmlspecialchars($data['products']->catid); ?>" required>
            <br>

            <label for="price"><strong>Price</strong></label>
            <br>
            <input type="text" name="price" id="price" class="form-control" value="<?php echo htmlspecialchars($data['products']->price); ?>" required>
            <br>

            <label for="thumb"><strong>Thumb</strong></label>
            <br>
            <!-- Display current image -->
            <?php if (!empty($data['products']->thumb)): ?>
                <img id="current-thumb" src="<?= $_ENV['ROOT'] ?>/assets/uploads/<?= htmlspecialchars($data['products']->thumb) ?>" alt="Current Thumb" style="max-width: 200px; height: auto;">
                <br>
            <?php endif; ?>
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
            <textarea name="description" id="description" class="form-control" style="height: 100px;" required><?php echo htmlspecialchars($data['products']->description); ?></textarea>
            <br>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a href="<?= $_ENV['ROOT'] ?>/admin/products">Back to List</a>
    </div>
</main>