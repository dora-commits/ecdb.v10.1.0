<!-- Main Dashboard -->

<main class="content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/reports" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#house-fill" />
            </svg>
            Dashboard
        </a>
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

    <canvas class="my-4 w-100" id="ordersChart" width="900" height="170"></canvas>
    <canvas class="my-4 w-100" id="category_product_chart" width="900" height="250"></canvas>
    <canvas class="my-4 w-100" id="user_order_chart" width="900" height="250"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            fetch("<?= $_ENV['ROOT'] ?>/api/orders")
                .then(response => response.json())
                .then(data => {

                    const labels = data.map(order => new Date(order.timestamp).toLocaleString());
                    const prices = data.map(order => order.totalprice);

                    // console.log(prices);

                    const ctx = document.getElementById('ordersChart').getContext('2d');

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

                const ctx = document.getElementById('category_product_chart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Products per Category',
                            data: values,
                            // borderColor: '#0014b1',
                            borderColor: 'rgb(54, 162, 235)',
                            // backgroundColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderWidth: 4,
                            pointBackgroundColor: '#FFC300',
                            pointBorderColor: '#0014b1',
                            pointRadius: 5,
                            pointBorderWidth: 2,
                            barThickness: 100,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
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

                // console.log(labels);

                const ctx = document.getElementById('user_order_chart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Total Price per UserID ($)",
                            data: values,
                            // borderColor: '#0014b1',
                            borderColor: 'rgb(255, 159, 64)',
                            // backgroundColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderWidth: 4,
                            pointBackgroundColor: '#FFC300',
                            pointBorderColor: '#0014b1',
                            pointRadius: 5,
                            pointBorderWidth: 2,
                            barThickness: 100,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
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