<!-- Main Dashboard -->

<main class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <!-- <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/dashboard" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#house-fill" />
            </svg>
            Dashboard
        </a> -->
        <div class="d-flex align-items-center gap-2">
            <a class="nav-link d-flex align-items-center gap-2"
                href="<?= $_ENV['ROOT'] ?>/admin/dashboard"
                style="font-weight: bold; font-size: 1.1rem; color: #007bff; transition: all 0.3s ease;">

                <svg class="bi" width="24" height="24" fill="currentColor" style="transition: transform 0.3s ease;">
                    <use xlink:href="#house-fill" />
                </svg>
                <span>Dashboard</span>
            </a>
        </div>

        <style>
            .nav-link:hover {
                color: #0056b3;
                text-decoration: none;
            }

            .nav-link:hover svg {
                transform: scale(1.2);
                fill: #0056b3;
            }

            .nav-link span {
                display: inline-block;
                transition: transform 0.3s ease;
            }

            .nav-link:hover span {
                transform: translateX(5px);
            }
        </style>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" id="shareBtn" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" id="exportBtn" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi">
                    <use xlink:href="#calendar3" />
                </svg>
                This week
            </button>
        </div>
    </div>

    <canvas class="my-4 w-100" id="ordersChart_dash" width="900" height="170"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            fetch("<?= $_ENV['ROOT'] ?>/api/orders")
                .then(response => response.json())
                .then(data => {

                    const labels = data.map(order => new Date(order.timestamp).toLocaleString());
                    const prices = data.map(order => order.totalprice);

                    // console.log(prices);

                    const ctx = document.getElementById('ordersChart_dash').getContext('2d');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total Price of Orders Tracking',
                                data: prices,
                                // borderColor: 'rgb(75, 192, 192)',
                                borderColor: '#0014b1',
                                backgroundColor: 'rgba(75, 192, 192, 1)',
                                // backgroundColor: '#9BD0F5',
                                borderWidth: 4, // Make the line thicker
                                pointBackgroundColor: '#FFC300', // Color of the points on the line
                                pointBorderColor: '#0014b1', // Border color of the points
                                pointRadius: 5, // Size of the points
                                pointBorderWidth: 2, // Border width of the points
                            }]
                        },
                        options: {}
                    });
                    // Export button functionality
                    document.getElementById('exportBtn').addEventListener('click', function() {
                        const wb = XLSX.utils.book_new();
                        const wsData = [
                            ['Date', 'Total Price'], // Header row
                            ...data.map(order => [new Date(order.timestamp).toLocaleString(), order.totalprice])
                        ];
                        const ws = XLSX.utils.aoa_to_sheet(wsData);
                        XLSX.utils.book_append_sheet(wb, ws, 'Orders Data');
                        XLSX.writeFile(wb, 'OrdersData.xlsx');
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        });
    </script>

    <!--  -->
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card" style="max-width: 20rem; ">
                <div class="card-img-top-wrapper">
                    <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/cover.jpg" class="card-img-top" alt="Product Image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">
                        Explore our collection of books, cameras, and mobiles perfect for every need, from reading to capturing memories and staying connected
                    </p>
                    <p class="card-text">
                        <!-- <strong>Products:</strong> -->
                        <span style="font-size: 30px; font-weight: bold; color: #007bff;">
                            <?php echo htmlspecialchars($count_products, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </p>
                    <a href="<?= $_ENV['ROOT'] ?>/admin/products" class="btn btn-primary">View Products</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="max-width: 20rem; ">
                <div class="card-img-top-wrapper">
                    <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/category.png" class="card-img-top" alt="Product Image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text">
                        Explore our collection of books, cameras, and mobiles perfect for every need, from reading to capturing memories and staying connected
                    </p>
                    <p class="card-text">
                        <!-- <kbd><strong>Categories:</strong></kbd> -->
                        <span style="font-size: 30px; font-weight: bold; color: #007bff;">
                            <?php echo htmlspecialchars($count_category, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </p>
                    <a href="<?= $_ENV['ROOT'] ?>/admin/category" class="btn btn-primary">View Categories</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="max-width: 20rem; ">
                <div class="card-img-top-wrapper">
                    <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/user.png" class="card-img-top" alt="Product Image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">
                        Explore our collection of books, cameras, and mobiles perfect for every need, from reading to capturing memories and staying connected
                    </p>
                    <p class="card-text">
                        <!-- <strong>Users:</strong> -->
                        <span style="font-size: 30px; font-weight: bold; color: #007bff;">
                            <?php echo htmlspecialchars($count_users, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </p>
                    <a href="<?= $_ENV['ROOT'] ?>/admin/users" class="btn btn-primary">View Users</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" style="max-width: 20rem; ">
                <div class="card-img-top-wrapper">
                    <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/order.png" class="card-img-top" alt="Product Image">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">
                        Explore our collection of books, cameras, and mobiles perfect for every need, from reading to capturing memories and staying connected
                    </p>
                    <p class="card-text">
                        <!-- <strong>Users:</strong> -->
                        <span style="font-size: 30px; font-weight: bold; color: #007bff;">
                            <?php echo htmlspecialchars($count_orders, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </p>
                    <a href="<?= $_ENV['ROOT'] ?>/admin/orders" class="btn btn-primary">View Orders</a>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    </div>
</main>