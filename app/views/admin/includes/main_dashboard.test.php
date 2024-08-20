<!-- Main Dashboard -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/dashboard" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#house-fill" />
            </svg>
            Dashboard
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

    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="151"></canvas> -->

    <!--  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <canvas id="ordersChart" width="900" height="400"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // const ctx = document.getElementById('ordersChart').getContext('2d');
            // if (ctx) {
            //     new Chart(ctx, {
            //         type: 'line',
            //         data: {
            //             labels: ['January', 'February', 'March', 'April', 'May'],
            //             datasets: [{
            //                 label: 'My First Dataset',
            //                 data: [65, 59, 80, 81, 56],
            //                 borderColor: 'rgb(75, 192, 192)',
            //                 backgroundColor: 'rgba(75, 192, 192, 0.2)',
            //             }]
            //         },
            //         options: {}
            //     });
            // } else {
            //     console.error('Canvas context could not be acquired.');
            // }
            fetch('http://localhost/ecom-clothes/public/api')
                .then(response => response.json())
                .then(data => {
                    // console.log(data); // Verify the data structure
                    // Proceed to process and display the chart
                    // createChart(data);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });

            function createChart(data) {
                const labels = data.map(item => item.uid);
                const prices = data.map(item => parseFloat(item.totalprice));
                // console.log(prices);
                const ctx = document.getElementById('ordersChart').getContext('2d');
                console.log(ctx);
                new Chart(ctx, {
                    type: 'line', // or 'bar', 'pie', etc.
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Price',
                            data: prices,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day'
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch("http://localhost/ecom-clothes/public/api")
                .then(response => response.json())
                .then(data => {
                    // Xử lý dữ liệu
                    const labels = data.map(order => new Date(order.timestamp).toLocaleString()); // Thay đổi định dạng thời gian nếu cần
                    const prices = data.map(order => order.totalprice);

                    console.log(prices);
                    // Tạo biểu đồ
                    const ctx = document.getElementById('ordersChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'My First Dataset',
                                data: prices,
                                // borderColor: 'rgb(75, 192, 192)',
                                // backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: '#0014b1',
                                backgroundColor: '#9BD0F5',
                            }]
                        },
                        options: {}
                    });
                    // const ordersChart = new Chart(ctx, {
                    //     type: 'line', // Loại biểu đồ, ví dụ 'line', 'bar', 'pie'
                    //     data: {
                    //         labels: labels,
                    //         datasets: [{
                    //             label: 'Total Price of Orders',
                    //             data: prices,
                    //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    //             borderColor: 'rgba(75, 192, 192, 1)',
                    //             borderWidth: 1
                    //         }]
                    //     },
                    //     options: {
                    //         scales: {
                    //             x: {
                    //                 type: 'time',
                    //                 time: {
                    //                     unit: 'hour'
                    //                 },
                    //                 title: {
                    //                     display: true,
                    //                     text: 'Timestamp'
                    //                 }
                    //             },
                    //             y: {
                    //                 beginAtZero: true,
                    //                 title: {
                    //                     display: true,
                    //                     text: 'Total Price'
                    //                 }
                    //             }
                    //         },
                    //         responsive: true,
                    //         plugins: {
                    //             legend: {
                    //                 position: 'top',
                    //             },
                    //             tooltip: {
                    //                 callbacks: {
                    //                     label: function(tooltipItem) {
                    //                         return `Total Price: $${tooltipItem.raw}`;
                    //                     }
                    //                 }
                    //             }
                    //         }
                    //     }
                    // });
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