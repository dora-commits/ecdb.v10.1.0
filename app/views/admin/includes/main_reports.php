<!-- Main Dashboard -->

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
                <button type="button" onclick="window.location.href='<?= $_ENV['ROOT'] ?>/admin/reports';" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2" style="font-weight: bold; font-size: 1rem;">
                    <svg class="bi" width="24" height="24" fill="currentColor">
                        <use xlink:href="#graph-up" />
                    </svg>
                    Report
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

    <canvas class="my-4 w-100" id="ordersChart_report" width="900" height="250"></canvas>
    <canvas class="my-4 w-100" id="category_product_chart_report" width="900" height="200"></canvas>
    <canvas class="my-4 w-100" id="user_order_chart_report" width="900" height="250"></canvas>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch("<?= $_ENV['ROOT'] ?>/api/orders")
            .then(response => response.json())
            .then(data => {
                const labels = data.map(order => new Date(order.timestamp).toLocaleString());
                const prices = data.map(order => order.totalprice);

                const ctx = document.getElementById('ordersChart_report').getContext('2d');

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

    <script>
        async function fetchData() {
            try {
                const [response1, response2] = await Promise.all([
                    fetch("<?= $_ENV['ROOT'] ?>/api/products"),
                    fetch("<?= $_ENV['ROOT'] ?>/api/category")
                ]);

                const products = await response1.json();
                const categories = await response2.json();

                const productCounts = {};

                categories.forEach(category => {
                    productCounts[category.name] = 0;
                });

                products.forEach(product => {
                    const category = categories.find(cat => cat.id === product.catid);
                    if (category) {
                        productCounts[category.name]++;
                    }
                });

                const labels = [];
                const values = [];

                for (const [key, value] of Object.entries(productCounts)) {
                    labels.push(key);
                    values.push(value);
                }

                const ctx = document.getElementById('category_product_chart_report').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Products per Category',
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
                                text: 'Total Products per Category',
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
                        ['Category', 'Number of Products'], // Header row
                        ...labels.map((label, index) => [label, values[index]])
                    ];
                    const ws = XLSX.utils.aoa_to_sheet(wsData);
                    XLSX.utils.book_append_sheet(wb, ws, 'Product Categories');
                    XLSX.writeFile(wb, 'ProductCategories.xlsx');
                });
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        fetchData();
    </script>

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

                const ctx = document.getElementById('user_order_chart_report').getContext('2d');
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
</main>