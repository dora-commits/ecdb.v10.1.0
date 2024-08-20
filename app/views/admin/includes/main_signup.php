<!-- Main -->

<main class="form-signin w-100 m-auto">
    <form method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php echo implode("<br>", $errors); ?>
            </div>
        <?php endif; ?>

        <img src="<?= $_ENV['ROOT'] ?>/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal text-center">Create Account</h1>

        <div class="form-floating mb-3">
            <input name="firstname" type="text" class="form-control" id="floatingInputFirstName" placeholder="First Name" required>
            <label for="floatingInputFirstName">First name</label>
        </div>
        <div class="form-floating mb-3">
            <input name="lastname" type="text" class="form-control" id="floatingInputLastName" placeholder="Last Name" required>
            <label for="floatingInputLastName">Last name</label>
        </div>
        <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control" id="floatingInputEmail" placeholder="name@example.com" required>
            <label for="floatingInputEmail">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control" id="floatingInputPassword" placeholder="Password" required>
            <label for="floatingInputPassword">Password</label>
        </div>

        <div class="form-check mb-3">
            <input name="terms" type="checkbox" class="form-check-input" id="checkTerms" value="1" required>
            <label class="form-check-label" for="checkTerms">Accept terms</label>
        </div>

        <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Sign up</button>
        
        <!-- <a class="text-blue d-block text-center" href="<?= $_ENV['ROOT'] ?>/admin/login">Already have an account? Login</a> -->
        <p class="text-center">
            Already have an account? <a class="text-blue" href="<?= $_ENV['ROOT'] ?>/admin/login">Login</a>
        </p>
        <p class="mt-5 mb-3 text-center text-body-secondary">&copy; 2024</p>
    </form>
</main>