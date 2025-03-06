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
      <div class="col-md-10 mx-auto col-lg-5">
        <form action="login-verify.php" class="p-4 p-md-5 border rounded-5 bg-body-tertiary" method="post">
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php
                                                                                                                            if (isset($_SESSION['loginError'])) {
                                                                                                                              echo $_SESSION['loginEmail'];
                                                                                                                              unset($_SESSION['loginEmail']);
                                                                                                                            }
                                                                                                                            ?>" />
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Hasło" name="password" value="<?php
                                                                                                                          if (isset($_SESSION['loginError'])) {
                                                                                                                            echo $_SESSION['loginPassword'];
                                                                                                                            unset($_SESSION['loginPassword']);
                                                                                                                          }
                                                                                                                          ?>" />
            <label for="floatingPassword">Hasło</label>
          </div>
          <?php
          if (isset($_SESSION['loginError'])) {
            echo "<span class='error'>Błędne dane logowania!</span>";
            unset($_SESSION['loginError']);
          }
          ?>
          <button class="btn btn-primary px-5 btn-lg rounded-pill text-center mx-3" type="submit">
            Zaloguj się
          </button>




        </form>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>
</body>

</html>