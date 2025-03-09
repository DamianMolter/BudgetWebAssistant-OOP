<?php include $this->resolve("partials/_header.php"); ?>

<body>

  <?php include $this->resolve("partials/_navbar.php"); ?>

  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>Dodaj przychód</h2>
      </div>

      <?php
      if (isset($_SESSION['success'])) {
        echo '<div class = "action-status"><p class = "success">Przychód został pomyślnie dodany!</p></div>';
        unset($_SESSION['success']);
      }


      if (isset($_SESSION['inputError'])) {
        echo '<div class="action-status"><p class="error">Podano błędne lub niekompletne informacje!</p></div>';
      }
      ?>


      <div class="row g-5">
        <div class="col-md-12 col-lg-12 text-center">
          <h4 class="mb-3">Szczegóły transakcji</h4>
          <form class="needs-validation" novalidate="" action="income-verify.php" method="post">
            <div class="row g-3 d-flex justify-content-center">
              <div class="col-3">
                <label for="address" class="form-label">Kwota</label>
                <div class="input-group">
                  <input type="number" min="0" step="5" class="form-control"
                    aria-label="Cash amount (with dot and two decimal places)" name="amount" value="" />
                  <span class="input-group-text">zł</span>
                </div>
              </div>

              <div class="col-3">
                <label for="address2" class="form-label">Data transakcji</label>
                <input id="startDate" class="form-control" type="date" name="date" />
              </div>


              <div class="col-md-4">
                <label for="state" class="form-label">Kategoria</label>
                <select class="form-select" id="state" required="" name="incomeCategory">
                  <option value="0">Wybierz kategorię</option>
                  <?php foreach ($userIncomeCategories as $userIncomeCategory) : ?>
                    <option value="<?php echo e($userIncomeCategory['id']); ?>">
                      <?php echo e($userIncomeCategory['name']); ?>
                    </option>
                  <?php endforeach; ?>

                </select>
                <div class="invalid-feedback">Wybierz jedną z opcji</div>
              </div>
            </div>

            <div class="form-group py-5">
              <label for="address" class="form-label">Komentarz(opcjonalnie)</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="incomeComment"></textarea>
            </div>
            <button class="w-100 btn btn-primary btn-lg" type="submit">
              Zapisz
            </button>
            <button class="w-100 btn btn-secondary btn-lg" type="reset">
              Anuluj
            </button>
          </form>
        </div>
      </div>
    </main>

    <?php include $this->resolve("partials/_footer.php"); ?>