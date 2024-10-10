<main class="content">
    <!-- Disable Card transform effect -->
    <style>
        .card:hover {
            transform: none !important;
        }
    </style>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- <h5 class="card-title mb-0"><kbd>Update Product</kbd></h5> -->
                <a class="btn btn-secondary" href="<?= $_ENV['ROOT'] ?>/admin/products">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back to List
                </a>
            </div>
            <div class="card-body">
                <form action="<?= $_ENV['ROOT'] ?>/admin/products_edit/<?php echo htmlspecialchars($data['products']->id); ?>" method="post">
                    <div class="form-group mb-3">

                        <label for="name"><strong>Name</strong></label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($data['products']->name); ?>" required>

                        <label for="catid"><strong>Category ID</strong></label>
                        <input type="text" name="catid" id="catid" class="form-control" value="<?php echo htmlspecialchars($data['products']->catid); ?>" required>

                        <label for="price"><strong>Price</strong></label>
                        <input type="text" name="price" id="price" class="form-control" value="<?php echo htmlspecialchars($data['products']->price); ?>" required>

                        <label for="thumb"><strong>Thumb</strong></label>
                        <img id="current-thumb"
                            src="<?= !empty($data['products']->thumb)
                                        ? $_ENV['ROOT'] . '/assets/uploads/' . htmlspecialchars($data['products']->thumb)
                                        : $_ENV['ROOT'] . '/assets/uploads/empty.png'; ?>"
                            alt="Current Thumb"
                            style="max-width: 200px; height: auto;">
                        <br>
                        <!-- File input to choose a new image -->
                        <input type="file" name="thumb" id="thumb" class="form-control" onchange="previewImage(event)">

                        <label for="description"><strong>Description</strong></label>
                        <textarea name="description" id="description" class="form-control" style="height: 100px;" required><?php echo htmlspecialchars($data['products']->description); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>

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
</main>