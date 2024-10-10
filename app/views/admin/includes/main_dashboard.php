<!-- Main Dashboard -->

<main class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <!-- <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/dashboard" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#house-fill" />
            </svg>
            Dashboard
        </a> -->
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" onclick="window.location.href='<?= $_ENV['ROOT'] ?>/admin/';" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2" style="font-weight: bold; font-size: 1rem;">
                    <svg class="bi" width="24" height="24" fill="currentColor">
                        <use xlink:href="#house-fill" />
                    </svg>
                    Dashboard
                </button>
            </div>
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

    <canvas class="my-4 w-100" id="ordersChart_dash" width="900" height="250"></canvas>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch("<?= $_ENV['ROOT'] ?>/api/orders")
            .then(response => response.json())
            .then(data => {
                const labels = data.map(order => new Date(order.timestamp).toLocaleString());
                const prices = data.map(order => order.totalprice);

                const ctx = document.getElementById('ordersChart_dash').getContext('2d');

                // Tạo gradient cho phần nền
                const gradient = ctx.createLinearGradient(0, 0, 0, 200); // Chiều cao 200
                gradient.addColorStop(0, 'rgba(255, 255, 255, 0)'); // Trong suốt ở trên
                gradient.addColorStop(1, 'rgba(0, 20, 177, 0.5)'); // Màu ở dưới

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Price of Orders Tracking',
                            data: prices,
                            borderColor: '#FFFFFF', // Màu đường là trắng
                            backgroundColor: gradient, // Sử dụng gradient cho phần dưới đường
                            borderWidth: 4, // Độ dày của đường
                            pointBackgroundColor: '#FFC300', // Màu của các điểm trên đường
                            pointBorderColor: '#FFFFFF', // Màu viền của các điểm
                            pointRadius: 5, // Kích thước của các điểm
                            pointBorderWidth: 2, // Độ dày viền của các điểm
                            fill: true, // Đổ đầy phần dưới đường
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true, // Giữ tỷ lệ chiều cao và chiều rộng như ban đầu
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 20, 177, 0.2)', // Màu cho các đường lưới
                                }
                            },
                            x: {
                                grid: {
                                    color: 'rgba(0, 20, 177, 0.1)', // Màu cho các đường lưới trên trục x
                                }
                            }
                        }
                    }
                });

                // Chức năng nút xuất dữ liệu
                document.getElementById('exportBtn').addEventListener('click', function() {
                    const wb = XLSX.utils.book_new();
                    const wsData = [
                        ['Date', 'Total Price'], // Dòng tiêu đề
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
            <div class="card modern-card circle-card"
                style="background: linear-gradient(135deg, #ff7e7e, #ffffff);"
                onclick="location.href='<?= $_ENV['ROOT'] ?>/admin/products';">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title">Products</h5>
                        <i class="bi bi-box card-icon"></i>
                    </div>
                    <div class="circle-background">
                        <span class="count-number">
                            <?php echo htmlspecialchars($count_products, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card modern-card circle-card"
                style="background: linear-gradient(135deg, #a1c4fd, #ffffff);"
                onclick="location.href='<?= $_ENV['ROOT'] ?>/admin/category';">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title">Categories</h5>
                        <i class="bi bi-folder card-icon"></i>
                    </div>
                    <div class="circle-background">
                        <span class="count-number">
                            <?php echo htmlspecialchars($count_category, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card modern-card circle-card"
                style="background: linear-gradient(135deg, #a18cd1, #ffffff);"
                onclick="location.href='<?= $_ENV['ROOT'] ?>/admin/users';">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title">Users</h5>
                        <i class="bi bi-people card-icon"></i>
                    </div>
                    <div class="circle-background">
                        <span class="count-number">
                            <?php echo htmlspecialchars($count_users, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card modern-card circle-card"
                style="background: linear-gradient(135deg, #ff9f40, #ffffff);"
                onclick="location.href='<?= $_ENV['ROOT'] ?>/admin/orders';">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-between align-items-start">
                        <h5 class="card-title">Orders</h5>
                        <i class="bi bi-cart card-icon"></i>
                    </div>
                    <div class="circle-background">
                        <span class="count-number">
                            <?php echo htmlspecialchars($count_orders, ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    </div>
</main>