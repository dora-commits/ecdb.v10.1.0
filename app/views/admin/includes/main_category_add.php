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
                href="<?= $_ENV['ROOT'] ?>/admin/category"
                style="font-weight: bold; font-size: 1.1rem; color: #007bff; transition: all 0.3s ease;">

                <svg class="bi" width="24" height="24" fill="currentColor" style="transition: transform 0.3s ease;">
                    <use xlink:href="#cart" />
                </svg>
                <span>Category</span>
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

    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="250"></canvas> -->

    <!-- Chart -->
    <canvas class="my-4 w-100" id="category_product_chart_add" width="900" height="250"></canvas>

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

                const ctx = document.getElementById('category_product_chart_add').getContext('2d');
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
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        fetchData();
    </script>
    <!--  -->

    <!-- Disable Card transform effect -->
    <style>
        .card:hover {
            transform: none !important;
        }
    </style>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <!-- <h5 class="card-title mb-0"><kbd>Add New Categories</kbd></h5> -->
                <a class="btn btn-secondary" href="<?= $_ENV['ROOT'] ?>/admin/category">
                    <i class="bi bi-arrow-left-circle me-2"></i>
                    Back to List
                </a>
            </div>
            <div class="card-body">
                <form action="<?= $_ENV['ROOT'] ?>/admin/category_add" method="post">
                    <div class="form-group mb-3">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</main>