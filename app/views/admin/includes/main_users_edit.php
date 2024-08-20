<!-- Main -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Dashboard</h1> -->
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/users" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#people" />
            </svg>
            Users
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

    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="215"></canvas> -->

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

                console.log(labels);

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
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        fetchData();
    </script>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!-- <h1 class="h2">Categories</h1> -->
        <kbd>
            <caption>Update User</caption>
        </kbd>
    </div>

    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($data['error'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <!-- <h2>Edit Category</h2> -->
    <form action="<?= $_ENV['ROOT'] ?>/admin/users_edit/<?php echo htmlspecialchars($data['users']->id); ?>" method="post">
        <div class="form-group">
            <label for="email"><strong>Email</strong></label>
            <br>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($data['users']->email); ?>" required>
            <br>

            <label for="password"><strong>Password</strong></label>
            <br>
            <input type="text" name="password" id="password" class="form-control" value="<?php echo htmlspecialchars($data['users']->password); ?>" required>
            <br>
            <!-- Timestamp :)))) -->
            <label for="timestamp"><strong>Timestamp</strong></label>
            <br>
            <!-- TODO: Make Invalid Timestamp by change type type="datetime-local" to type="text" and write sth wrong time-->
            <input type="datetime-local" name="timestamp" id="timestamp" class="form-control" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($data['users']->timestamp))); ?>" required>
            <br>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a href="<?= $_ENV['ROOT'] ?>/admin/users">Back to List</a>
    </div> -->

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <p class="text-center mb-0">
            <a class="text-blue d-flex align-items-center align-bottom" href="<?= $_ENV['ROOT'] ?>/admin/users">
                <i class="bi bi-arrow-left-circle me-2 icon-size"> </i>
                Back to List
            </a>
        </p>
    </div>
</main>