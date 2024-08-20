<!-- Main -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a class="nav-link d-flex align-items-center gap-2" href="<?= $_ENV['ROOT'] ?>/admin/orders" style="font-weight: bold; font-size: 1.1rem; color: blue;">
            <svg class="bi" width="24" height="24" fill="blue">
                <use xlink:href="#file-earmark" />
            </svg>
            Orders
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
    <!--  -->
    <canvas class="my-4 w-100" id="myChart" width="900" height="250"></canvas>

    <!-- Display the error message if it exists -->
    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($data['error']); ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive small">
        <table class="table table-striped table-sm table-hover table-bordered caption-top">
            <!-- <caption>List of Products</caption> -->
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="text-align: center; width: 110px;">No.</th>
                    <th scope="col" style="text-align: center; width: 110px;">User</th>
                    <th scope="col" style="text-align: center; width: 110px;">Total Price</th>
                    <th scope="col" style="text-align: center; width: 110px;">Status</th>
                    <th scope="col" style="text-align: center;">Payment Mode</th>
                    <th scope="col" style="text-align: center;">Timestamp</th>
                    <th scope="col" style="text-align: center; width: 110px;">Edit</th>
                    <th scope="col" style="text-align: center; width: 110px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <th style="text-align: center;"><?php echo htmlspecialchars($order->id, ENT_QUOTES, 'UTF-8'); ?></th>
                            <td style="text-align: center;"><?php echo htmlspecialchars($order->uid, ENT_QUOTES, 'UTF-8'); ?></td>
                            <!-- <td style="text-align: center;"><?php echo htmlspecialchars($order->totalprice, ENT_QUOTES, 'UTF-8'); ?></td> -->
                            <td style="text-align: center;"><?php echo htmlspecialchars('$' . number_format($order->totalprice, 2, '.', ','), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($order->orderstatus, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($order->paymentmode, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td style="text-align: center;"><?php echo htmlspecialchars($order->timestamp, ENT_QUOTES, 'UTF-8'); ?></td>

                            <td style="text-align: center;">
                                <a href="#" class="text-blue">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                            <td style="text-align: center;">
                                <a href="<?= $_ENV['ROOT'] ?>/admin/orders_delete/<?php echo htmlspecialchars($order->id); ?>" onclick="return confirm('Are you sure?');" class="text-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    </div>
</main>