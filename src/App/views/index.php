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
          <a href="/login"><button
              class="btn btn-primary px-5 btn-lg rounded-pill text-center mx-3"
              type="button">
              Logowanie
            </button></a>

          <a href="/register"><button
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

  <?php include $this->resolve("partials/_footer.php"); ?>