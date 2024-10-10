<!-- Main -->

<main class="form-signin w-100 m-auto">
    <form method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?= implode("<br>", $errors) ?>
            </div>
        <?php endif; ?>
        <img class="mb-4" src="<?= $_ENV['ROOT'] ?>/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control" id="floatingInput" autocomplete="on" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input name="checkbox" type="checkbox" value="remember-me"> Accept terms
            </label>
        </div>

        <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Sign in</button>
        <!-- <a class="text-blue" href="<?= $_ENV['ROOT'] ?>/admin">Dashboard</a> -->
        <!-- <a class="text-blue" href="<?= $_ENV['ROOT'] ?>/admin/signup/">Sign up</a> -->
        <p class="text-center">
            Don't have an account? <a class="text-blue" href="<?= $_ENV['ROOT'] ?>/admin/signup">Sign up</a>
        </p>
        <!-- <a class="text-blue d-block text-center" href="<?= $_ENV['ROOT'] ?>/admin/signup">Already have an account? Login</a> -->
        <p class="mt-5 mb-3 text-center text-body-secondary">&copy; 2024 - Pham Truong Giang</p>
    </form>
</main>