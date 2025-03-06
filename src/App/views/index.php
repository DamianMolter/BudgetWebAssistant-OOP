<?php include $this->resolve("partials/_header.php"); ?>

<body class="dark-green">
  <header>
    <div class="container passion">
      <div class="passion">
        <h3>Stworzony z pasją</h3>
      </div>
    </div>
  </header>

  <main>
    <div class="container mt-1 px-2">
      <div class="text-center px-5">
        <h1>Twój Zaufany Asystent Budżetowy</h1>
        <p class="col-sm-12 col-lg-8 mx-auto fs-5 text-white my-4">
          Zapanuj nad swoimi finansami już dziś!
        </p>
        <div class="d-flex-inline gap-5 mb-5 col-12">
          <a href="./login.php"><button
              class="btn btn-primary px-5 btn-lg rounded-pill text-center mx-3"
              type="button">
              Logowanie
            </button></a>

          <a href="./register.php"><button
              class="btn btn-primary px-5 btn-lg rounded-pill text-center mx-3"
              type="button">
              Rejestracja
            </button></a>
        </div>
        <?php
        if (isset($_SESSION['registerSuccessfull'])) {
          echo '<p class = "success">Rejestracja zakończona sukcesem! Zaloguj się na Twoje konto!</p>';
          unset($_SESSION['registerSuccessfull']);
        }
        ?>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-body-secondary text-center text-small">
    <p class="mb-1">© 2024 By Damian Molter</p>
  </footer>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>