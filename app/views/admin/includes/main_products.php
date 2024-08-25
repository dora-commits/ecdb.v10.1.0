<!-- Main -->

<main class="content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/products" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#cart" />
            </svg>
            Products
        </a>
    </div>
    <!--  -->
    <!-- <h2>Products</h2> -->

    <div class="table-responsive small">
        <!-- Display the error message if it exists -->
        <?php if (!empty($data['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($data['error']); ?>
            </div>
        <?php endif; ?>
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <!-- <caption>List of Products</caption> -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center; width: 110px;">No.</th>
                    <th scope="col" style="text-align: center;">Name</th>
                    <th scope="col" style="text-align: center; width: 110px;">Type</th>
                    <th scope="col" style="text-align: center; width: 110px;">Price</th>
                    <th scope="col" style="text-align: center;">Thumb</th>
                    <th scope="col" style="text-align: center;">Description</th>
                    <th scope="col" style="text-align: center; width: 110px;">Edit</th>
                    <th scope="col" style="text-align: center; width: 110px;">Delete</th>
                </tr>
            </thead>
            <tbody id="productsTableBody">
                <!--  -->
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <button id="prevPageBtn" class="btn btn-outline-secondary btn-sm">Previous</button>
            <button id="nextPageBtn" class="btn btn-outline-secondary btn-sm">Next</button>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <a href="<?= $_ENV['ROOT'] ?>/admin/products_add" class="btn btn-primary">Add new product</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPage = 1;
            const rowsPerPage = 5;
            let totalPages = 1;
            let productsData = [];

            // Fetch orders data from the API
            fetch("<?= $_ENV['ROOT'] ?>/api/products")
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    productsData = data;
                    // console.log(productsData);
                    totalPages = Math.ceil(data.length / rowsPerPage);
                    displayPage(currentPage);

                    // Enable/disable buttons based on the page
                    toggleButtons();
                })
                .catch(error => console.error('Error fetching data:', error));


            // console.log(productsData);
            // Function to format price as USD
            function formatPrice(price) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD'
                }).format(price);
            }
            // Function to display a specific page
            function displayPage(page) {
                // console.log(productsData);

                const tbody = document.getElementById('productsTableBody');
                tbody.innerHTML = '';
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                productsData.slice(start, end).forEach((product, index) => {
                    tbody.innerHTML += `
                        <tr>
                        <th style="text-align: center;">${product.id}</th>
                        <td style="text-align: center;">${product.name}</td>
                        <td style="text-align: center;">${product.catid}</td>
                        <td style="text-align: center;">${formatPrice(product.price)}</td>
                        <td style="text-align: center;">
                            <img src="<?= $_ENV['ROOT'] ?>/assets/uploads/${product.thumb}" alt="${product.thumb}>" class="thumb">
                        </td>
                        <td style="text-align: justify;">${product.description}</td>
                        <td style="text-align: center;">
                            <a href="#" class="text-blue">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/products_edit/${product.id}" class="text-blue">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td style="text-align: center;">
                            <a href="<?= $_ENV['ROOT'] ?>/admin/products_delete/${product.id}" onclick="return confirm('Are you sure?');" class="text-danger">
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