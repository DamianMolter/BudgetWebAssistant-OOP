<?php include $this->resolve("partials/_header.php"); ?>

<body>
  <header>
    <div class="text-center">
      <h1>Zaloguj się</h1>
    </div>
  </header>

  <main>
    <div class="container col-xl-10 col-xxl-8 px-4 py-2">
      <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start">
          <blockquote class="blockquote">
            <p class="mb-0">
              „Najpewniejszą drogą do sukcesu jest próbować,
              jeszcze ten jeden raz.”
            </p>
          </blockquote>
        </div>
        <div class="col-md-10 mx-auto col-lg-5 align-items-center">
          <form class="p-4 p-md-5 border rounded-5 bg-body-tertiary" method="POST">
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <div class="form-floating mb-3">
              <input type="email"
                class="form-control"
                id="floatingInput"
                placeholder="name@example.com"
                name="email"
                value="<?php echo e($oldFormData['email'] ?? ''); ?>" />
              <?php if (array_key_exists('email', $errors)) : ?>
                <span class='error'>
                  <?php echo e($errors['email'][0]); ?>
                </span>
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
                <span class='error'>
                  <?php echo e($errors['password'][0]); ?>
                </span>
              <?php endif; ?>
              <label for="floatingPassword">Hasło</label>
            </div>
            <button class="btn btn-primary px-5 btn-lg rounded-pill text-center mx-3" type="submit">
              Zaloguj się
            </button>
            <div class="return"><a href="/">
                Powrót do strony głównej
              </a>
              <br />
              Nie masz jeszcze konta? <a href="/register">Załóż je!</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <?php include $this->resolve("partials/_footer.php"); ?>