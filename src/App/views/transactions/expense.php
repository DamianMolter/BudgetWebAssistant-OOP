<?php include $this->resolve("../partials/_header.php"); ?>

<body>

  <?php include $this->resolve("partials/_navbar.php"); ?>

  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h2>Dodaj wydatek</h2>
      </div>

      <?php
      if (isset($_SESSION['success'])) {
        echo '<div class = "action-status"><p class = "success">Wydatek został pomyślnie dodany!</p></div>';
        unset($_SESSION['success']);
      }


      if (isset($_SESSION['inputError'])) {
        echo '<div class = "action-status"><p class= "error">Podano błędne lub niekompletne informacje!</p></div>';
        unset($_SESSION['inputError']);
      }
      ?>



      <div class="row g-5">
        <div class="col-md-12 col-lg-12 text-center">
          <h4 class="mb-3">Szczegóły transakcji</h4>
          <form class="needs-validation" novalidate="" action="expense-verify.php" method="post">
            <div class="row g-3 d-flex justify-content-center">
              <div class="col-3">
                <label for="address" class="form-label">Kwota</label>
                <div class="input-group">
                  <input type="number" min="0" step="5" class="form-control"
                    aria-label="Cash amount (with dot and two decimal places)" name="amount" value="<?php
                                                                                                    if (isset($_SESSION['inputError'])) {
                                                                                                      echo $_SESSION['givenAmount'];
                                                                                                      unset($_SESSION['givenAmount']);
                                                                                                      unset($_SESSION['inputError']);
                                                                                                    }
                                                                                                    ?>" />
                  <span class="input-group-text">zł</span>
                </div>
              </div>

              <div class="col-3">
                <label for="address2" class="form-label">Data transakcji</label>
                <input id="startDate" class="form-control" type="date" name="date" />
              </div>

              <div class="col-md-5">
                <label for="country" class="form-label">Sposób płatności</label>
                <select class="form-select" id="country" required="" name="paymentMethod">
                  <option value="0">Wybierz metodę płatności</option>
                  <?php

                  require_once 'connect.php';
                  $loadPaymentMethodsQuery = $db->prepare('SELECT id, name FROM payment_methods_assigned_to_users
                                                                WHERE user_id=:userId');
                  $loadPaymentMethodsQuery->bindValue(':userId', $_SESSION['loggedUserId'], PDO::PARAM_INT);
                  $loadPaymentMethodsQuery->execute();

                  $paymentMethods = $loadPaymentMethodsQuery->fetchAll();

                  foreach ($paymentMethods as $paymentMethod) {
                    echo '<option value = "' . $paymentMethod['id'] . '">' . $paymentMethod['name'] . '</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-4">
                <label for="state" class="form-label">Kategoria</label>
                <select class="form-select" id="state" required="" name="expenseCategory">
                  <option value="0">Wybierz kategorię</option>
                  <?php

                  require_once 'connect.php';
                  $loadExpenseCategoriesQuery = $db->prepare('SELECT id, name FROM expenses_category_assigned_to_users
                                                                WHERE user_id=:userId');
                  $loadExpenseCategoriesQuery->bindValue(':userId', $_SESSION['loggedUserId'], PDO::PARAM_INT);
                  $loadExpenseCategoriesQuery->execute();

                  $expenseCategories = $loadExpenseCategoriesQuery->fetchAll();

                  foreach ($expenseCategories as $expenseCategory) {
                    echo '<option value = "' . $expenseCategory['id'] . '">' . $expenseCategory['name'] . '</option>';
                  }
                  ?>
                </select>
                <div class="invalid-feedback">Wybierz jedną z opcji</div>
              </div>
            </div>

            <div class="form-group py-5">
              <label for="address" class="form-label">Komentarz(opcjonalnie)</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="expenseComment"></textarea>
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

    <?php include $this->resolve("../partials/_footer.php"); ?>