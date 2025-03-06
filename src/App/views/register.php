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
          <form class="p-4 p-md-5 border rounded-5 bg-body-tertiary" action="register-verify.php" method="post">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="Imię" name="name" value="<?php
                                                                                                                if (isset($_SESSION['givenName'])) {
                                                                                                                  echo $_SESSION['givenName'];
                                                                                                                  unset($_SESSION['givenName']);
                                                                                                                }

                                                                                                                ?>" />

              <label for="floatingInput">Imię</label>
              <?php
              if (isset($_SESSION['nameError'])) {
                echo $_SESSION['nameError'];
                unset($_SESSION['nameError']);
              }
              ?>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php
                                                                                                                              if (isset($_SESSION['givenEmail'])) {
                                                                                                                                echo $_SESSION['givenEmail'];
                                                                                                                                unset($_SESSION['givenEmail']);
                                                                                                                              }
                                                                                                                              ?>" />
              <label for="floatingInput">Email</label>
              <?php
              if (isset($_SESSION['emailError'])) {
                echo $_SESSION['emailError'];
                unset($_SESSION['emailError']);
              }
              ?>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Hasło" name="passwordOne" value="<?php
                                                                                                                              if (isset($_SESSION['givenPasswordOne'])) {
                                                                                                                                echo $_SESSION['givenPasswordOne'];
                                                                                                                                unset($_SESSION['givenPasswordOne']);
                                                                                                                              }
                                                                                                                              ?>" />
              <label for="floatingPassword">Hasło</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Powtórz hasło" name="passwordTwo" value="<?php
                                                                                                                                      if (isset($_SESSION['givenPasswordTwo'])) {
                                                                                                                                        echo $_SESSION['givenPasswordTwo'];
                                                                                                                                        unset($_SESSION['givenPasswordTwo']);
                                                                                                                                      }
                                                                                                                                      ?>" />
              <?php
              if (isset($_SESSION['passwordError'])) {
                echo $_SESSION['passwordError'];
                unset($_SESSION['passwordError']);
              }
              ?>
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