<!-- Main -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/products" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#cart" />
            </svg>
            Products
        </a>
    </div>
    <!--  -->
    <!-- <h2>Products</h2> -->
    <!-- Display the error message if it exists -->
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($data['error']); ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive small">
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <!-- <caption>List of Products</caption> -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center; width: 110px;">No.</th>
                    <th scope="col" style="text-align: center;">Name</th>
                    <th scope="col" style="text-align: center; width: 110px;">Type</th>
                    <th scope="col" style="text-align: center; width: 110px;">Price</th>
                    <th scope="col" style="text-align: center;">Thumb</th>
                    <th scope="col" style="text-align: center;">Description</th>
                    <th scope="col" style="text-align: center; width: 110px;">Edit</th>
                    <th scope="col" style="text-align: center; width: 110px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <th style="text-align: center;"><?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?></th>
                            <td><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars('$' . number_format($product->price, 2, '.', ','), ENT_QUOTES, 'UTF-8'); ?></td>
                            <!-- <td style="text-align: center;"><img src="<?= $_ENV['ROOT'] ?>/assets/uploads/<?= $product->thumb; ?>" alt="<?= $product->thumb; ?>"></td> -->
                            <td style="text-align: center;">
                                <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/<?= $product->thumb; ?>" alt="<?= $product->thumb; ?>" class="thumb">
                            </td>
                            <td><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/products_edit/<?php echo htmlspecialchars($product->id); ?>" class="text-blue">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/products_delete/<?php echo htmlspecialchars($product->id); ?>" onclick="return confirm('Are you sure?');" class="text-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <a href="<?= $_ENV['ROOT'] ?>/admin/products_add" class="btn btn-primary">Add new product</a>
    </div>
</main>