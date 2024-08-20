<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/category" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#cart" />
            </svg>
            Category
        </a>

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
    <canvas class="my-4 w-100" id="category_product_chart" width="900" height="250"></canvas>

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
                            borderColor:'rgb(54, 162, 235)',
                            // backgroundColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor:'rgba(54, 162, 235, 0.2)',
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

    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        
    </div> -->
    <!-- Display the error message if it exists -->
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($data['error']); ?>
        </div>
    <?php endif; ?>

    <!-- <div class="table-responsive small">
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <caption>List of Categories</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center;">No.</th>
                    <th scope="col" style="text-align: center;">Name</th>
                    <th scope="col" style="text-align: center;">Edit</th>
                    <th scope="col" style="text-align: center;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><a href="<?= $_ENV['ROOT'] ?>/admin/category_edit/<?php echo htmlspecialchars($category->id); ?>">Edit</a> </td>
                            <td style="text-align: center;"><a href="<?= $_ENV['ROOT'] ?>/admin/category_delete/<?php echo htmlspecialchars($category->id); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No categories found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div> -->

    <div class="table-responsive small">
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <caption>List of Categories</caption>
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center; width: 200px;">No.</th>
                    <th scope="col" style="text-align: center;">Name</th>
                    <th scope="col" style="text-align: center; width: 200px;">Edit</th>
                    <th scope="col" style="text-align: center; width: 200px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td style="text-align: center;"><?php echo htmlspecialchars($category->id, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/category_edit/<?php echo htmlspecialchars($category->id); ?>" class="text-blue">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/category_delete/<?php echo htmlspecialchars($category->id); ?>" onclick="return confirm('Are you sure?');" class="text-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No categories found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <a href="<?= $_ENV['ROOT'] ?>/admin/category_add" class="btn btn-primary">Add new category</a>
    </div>
</main>