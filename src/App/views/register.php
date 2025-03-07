<?php include $this->resolve("partials/_header.php"); ?>

<body>
  <header>
    <div class="text-center">
      <h1>Zarejestruj się</h1>
    </div>
  </header>

  <main>
    <div class="container col-xl-10 col-xxl-8 px-4 py-2">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <blockquote class="blockquote">
            <p class="mb-0">
              „Nigdy nie wmawiaj sobie, że nie dasz rady. Pewność siebie to
              podstawa osiągnięcia sukcesu.”
            </p>
          </blockquote>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
          <form class="p-4 p-md-5 border rounded-5 bg-body-tertiary" method="POST">
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <div class="form-floating mb-3">
              <input type="text"
                class="form-control"
                id="floatingInput"
                placeholder="Imię"
                name="name"
                value="<?php echo e($oldFormData['name'] ?? ''); ?>" />
              <?php if (array_key_exists('name', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                  <?php echo e($errors['name'][0]); ?>
                </div>
              <?php endif; ?>

              <label for="floatingInput">Imię</label>

            </div>
            <div class="form-floating mb-3">
              <input type="email"
                class="form-control"
                id="floatingInput"
                placeholder="name@example.com"
                name="email"
                value="<?php echo e($oldFormData['email'] ?? ''); ?>" />
              <?php if (array_key_exists('email', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                  <?php echo e($errors['email'][0]); ?>
                </div>
              <?php endif; ?>
              <label for="floatingInput">Email</label>

            </div>
            <div class="form-floating mb-3">
              <input type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Hasło"
                name="password"
                value="" />
              <?php if (array_key_exists('password', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                  <?php echo e($errors['password'][0]); ?>
                </div>
              <?php endif; ?>
              <label for="floatingPassword">Hasło</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Powtórz hasło"
                name="confirmPassword"
                value="" />
              <?php if (array_key_exists('confirmPassword', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                  <?php echo e($errors['confirmPassword'][0]); ?>
                </div>
              <?php endif; ?>
              <label for="floatingPassword">Powtórz hasło</label>
            </div>
            <button class="btn btn-primary px-5 btn-lg rounded-pill text-center mx-3" type="submit">
              Zarejestruj się
            </button>
          </form>
        </div>
      </div>
    </div>

  </main>

  <?php include $this->resolve("partials/_footer.php"); ?>