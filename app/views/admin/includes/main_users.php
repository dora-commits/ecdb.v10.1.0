<!-- Main -->

<main class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" onclick="window.location.href='<?= $_ENV['ROOT'] ?>/admin/dashboard';" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2" style="font-weight: bold; font-size: 1rem;">
                    <svg class="bi" width="24" height="24" fill="currentColor">
                        <use xlink:href="#house-fill" />
                    </svg>
                    Dashboard
                </button>
                <!-- <span style="font-size: 1.2rem; color: #007bff;">&#9679;</span> This is a dot icon -->
                <button type="button" onclick="window.location.href='<?= $_ENV['ROOT'] ?>/admin/users';" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2" style="font-weight: bold; font-size: 1rem;">
                    <svg class="bi" width="24" height="24" fill="currentColor">
                        <use xlink:href="#people" />
                    </svg>
                    Customers
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

        <!--  -->
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

    <canvas class="my-4 w-100" id="user_order_chart" width="900" height="250"></canvas>

    <script>
        async function fetchData() {
            try {
                const [response] = await Promise.all([
                    fetch("<?= $_ENV['ROOT'] ?>/api/orders")
                ]);

                const orders = await response.json();

                // Initialize the object to store total price per user
                const totalPrices = {};

                // Aggregate the total price for each user (uid)
                orders.forEach(order => {
                    const userId = order.uid;
                    const totalPrice = parseFloat(order.totalprice);

                    if (!totalPrices[userId]) {
                        totalPrices[userId] = 0;
                    }

                    totalPrices[userId] += totalPrice;
                });

                // Prepare the labels and values arrays
                const labels = [];
                const values = [];

                // Map the total prices object to labels and values arrays
                Object.keys(totalPrices).forEach(userId => {
                    labels.push(userId);
                    values.push(totalPrices[userId]);
                });

                const ctx = document.getElementById('user_order_chart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Total Price per UserID ($)",
                            data: values,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.9)',
                                'rgba(255, 99, 132, 0.9)',
                                'rgba(255, 206, 86, 0.9)',
                                'rgba(75, 192, 192, 0.9)',
                                'rgba(153, 102, 255, 0.9)',
                                'rgba(255, 159, 64, 0.9)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 3,
                            barThickness: 70, 
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: 'Total Price per User ID',
                                font: {
                                    size: 18,
                                    weight: 'bold'
                                },
                                color: '#fff'
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'top',
                                color: '#333',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#fff',
                                    font: {
                                        size: 12
                                    }
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.8)',
                                    lineWidth: 1,
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#fff',
                                    font: {
                                        size: 14
                                    }
                                },
                                grid: {
                                    display: true
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels],
                });

                // Export button functionality
                document.getElementById('exportBtn').addEventListener('click', function() {
                    const wb = XLSX.utils.book_new();
                    const wsData = [
                        ['User ID', 'Total Price'], // Header row
                        ...labels.map((label, index) => [label, values[index]])
                    ];
                    const ws = XLSX.utils.aoa_to_sheet(wsData);
                    XLSX.utils.book_append_sheet(wb, ws, 'User Orders');
                    XLSX.writeFile(wb, 'UserOrders.xlsx');
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        fetchData();
    </script>


    <div class="table-responsive small">
        <!-- Display the error message if it exists -->
        <?php if (!empty($data['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($data['error']); ?>
            </div>
        <?php endif; ?>
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <caption>List of Users</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center;">No.</th>
                    <th scope="col" style="text-align: center;">Email</th>
                    <th scope="col" style="text-align: center;">Password</th>
                    <th scope="col" style="text-align: center;">Timestamp</th>
                    <th scope="col" style="text-align: center; width: 150px;">Edit</th>
                    <th scope="col" style="text-align: center; width: 150px;">Delete</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                <!--  -->
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
            let usersData = [];

            // Fetch orders data from the API
            fetch("<?= $_ENV['ROOT'] ?>/api/users")
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    usersData = data;
                    // console.log(usersData);
                    // console.log(usersData);
                    totalPages = Math.ceil(data.length / rowsPerPage);
                    displayPage(currentPage);

                    // Enable/disable buttons based on the page
                    toggleButtons();
                })
                .catch(error => console.error('Error fetching data:', error));


            // console.log(usersData);
            // Function to format price as USD
            function formatPrice(price) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(price);
            }
            // Function to display a specific page
            function displayPage(page) {
                // console.log(usersData);

                const tbody = document.getElementById('usersTableBody');
                tbody.innerHTML = '';
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                usersData.slice(start, end).forEach((user, index) => {
                    tbody.innerHTML += `
                        <tr>
                        <th style="text-align: center;">${user.id}</th>
                        <td style="text-align: center;">${user.email}</td>
                        <td style="text-align: center;">${user.password}</td>
                        <td style="text-align: center;">${user.timestamp}</td>
                        <td style="text-align: center;">
                            <a href="#" class="text-blue">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/users_edit/${user.id}" class="text-primary">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a href="<?= $_ENV['ROOT'] ?>/admin/users_delete/${user.id}" onclick="return confirm('Are you sure?');" class="text-danger">
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