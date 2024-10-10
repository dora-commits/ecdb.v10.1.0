<!-- Main -->

<main class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <div class="d-flex align-items-center gap-2">
            <a class="nav-link d-flex align-items-center gap-2"
                href="<?= $_ENV['ROOT'] ?>/admin/dashboard"
                style="font-weight: bold; font-size: 1.1rem; color: #007bff; transition: all 0.3s ease;">

                <svg class="bi" width="24" height="24" fill="currentColor" style="transition: transform 0.3s ease;">
                    <use xlink:href="#house-fill" />
                </svg>
                <span>Dashboard</span>
            </a>
            <span style="font-size: 1.2rem; color: #007bff;">&#9679;</span> <!-- This is a dot icon -->
            <a class="nav-link d-flex align-items-center gap-2"
                href="<?= $_ENV['ROOT'] ?>/admin/orders"
                style="font-weight: bold; font-size: 1.1rem; color: #007bff; transition: all 0.3s ease;">

                <svg class="bi" width="24" height="24" fill="currentColor" style="transition: transform 0.3s ease;">
                    <use xlink:href="#file-earmark" />
                </svg>
                <span>Orders</span>
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
    <!--  -->
    <canvas class="my-4 w-100" id="ordersChart" width="900" height="215"></canvas>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch("<?= $_ENV['ROOT'] ?>/api/orders")
            .then(response => response.json())
            .then(data => {
                const labels = data.map(order => new Date(order.timestamp).toLocaleString());
                const prices = data.map(order => order.totalprice);

                const ctx = document.getElementById('ordersChart').getContext('2d');

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

    <div class="table-responsive small">
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <!-- Display the error message if it exists -->
            <?php if (!empty($data['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($data['error']); ?>
                </div>
            <?php endif; ?>
            <caption>List of Orders</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center; width: 110px;">No.</th>
                    <th scope="col" style="text-align: center; width: 110px;">User</th>
                    <th scope="col" style="text-align: center; width: 110px;">Total Price</th>
                    <th scope="col" style="text-align: center; width: 140px;">Status</th>
                    <th scope="col" style="text-align: center;">Payment Mode</th>
                    <th scope="col" style="text-align: center;">Timestamp</th>
                    <th scope="col" style="text-align: center; width: 110px;">Edit</th>
                    <th scope="col" style="text-align: center; width: 110px;">Delete</th>
                </tr>
            </thead>
            <tbody id="ordersTableBody">
                <!-- .... -->
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <button id="prevPageBtn" class="btn btn-outline-secondary btn-sm">Previous</button>
            <button id="nextPageBtn" class="btn btn-outline-secondary btn-sm">Next</button>
        </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPage = 1;
            const rowsPerPage = 5;
            let totalPages = 1;
            let ordersData = [];

            // Fetch orders data from the API
            fetch("<?= $_ENV['ROOT'] ?>/api/orders")
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    ordersData = data;
                    // console.log(ordersData);
                    totalPages = Math.ceil(data.length / rowsPerPage);
                    displayPage(currentPage);

                    // Enable/disable buttons based on the page
                    toggleButtons();
                })
                .catch(error => console.error('Error fetching data:', error));


            // console.log(ordersData);
            // Function to format price as USD
            function formatPrice(price) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(price);
            }
            // Function to display a specific page
            function displayPage(page) {
                // console.log(ordersData);

                const tbody = document.getElementById('ordersTableBody');
                tbody.innerHTML = '';
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                ordersData.slice(start, end).forEach((order, index) => {
                    tbody.innerHTML += `
                        <tr>
                        <th style="text-align: center;">${order.id}</th>
                        <td style="text-align: center;">${order.uid}</td>
                        <td style="text-align: center;">${formatPrice(order.totalprice)}</td>
                        <td style="text-align: center;">${order.orderstatus}</td>
                        <td style="text-align: center;">${order.paymentmode}</td>
                        <td style="text-align: center;">${order.timestamp}</td>
                        <td style="text-align: center;">
                            <a href="#" class="text-blue">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a href="<?= $_ENV['ROOT'] ?>/admin/orders_delete/${order.id}" onclick="return confirm('Are you sure?');" class="text-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                        </tr>
                    `;
                });
            }

            // Function to enable/disable buttons
            function toggleButtons() {
                document.getElementById('prevPageBtn').disabled = currentPage === 1;
                document.getElementById('nextPageBtn').disabled = currentPage === totalPages;
            }

            // Handle click on "Previous" button
            document.getElementById('prevPageBtn').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    displayPage(currentPage);
                    toggleButtons();
                }
            });

            // Handle click on "Next" button
            document.getElementById('nextPageBtn').addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayPage(currentPage);
                    toggleButtons();
                }
            });
        });
    </script>
</main>