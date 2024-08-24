<!doctype html>
<html lang="en" data-bs-theme="auto">

<!-- Head -->
<?php require_once(__DIR__ . "/includes/head.php"); ?>

<body>
    <!-- Toggle -->
    <?php require_once(__DIR__ . "/includes/toggle.php"); ?>

    <!-- Header -->

    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar">
            <?php require_once(__DIR__ . "/includes/sidebar.php"); ?>
        </aside>

        <div class="main-content"> 
            <!-- Header -->
            <!-- Main -->
            <?php require_once(__DIR__ . "/includes/main_products_add.php"); ?>
            <!-- Footer -->
            <?php require_once(__DIR__ . "/includes/footer.php"); ?>
        </div>
    </div>

    <!-- Script -->
    <?php require_once(__DIR__ . "/includes/script.php"); ?>
</body>

</html>