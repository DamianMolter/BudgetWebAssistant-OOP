<?php include $this->resolve("partials/_header.php"); ?>

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
          <form class="needs-validation" novalidate="" method="post">
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <div class="row g-3 d-flex justify-content-center">
              <div class="col-3">
                <label for="address" class="form-label">Kwota</label>
                <div class="input-group">
                  <input type="number"
                    min="0"
                    step="5"
                    class="form-control"
                    aria-label="Cash amount (with dot and two decimal places)"
                    name="amount"
                    value="<?php echo e($oldFormData['amount'] ?? ''); ?>" />
                  <span class="input-group-text">zł</span>
                </div>
                <?php if (array_key_exists('amount', $errors)) : ?>
                  <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo e($errors['amount'][0]); ?>
                  </div>
                <?php endif; ?>
              </div>

              <div class="col-3">
                <label for="address2" class="form-label">Data transakcji</label>
                <input id="startDate"
                  class="form-control"
                  type="date"
                  name="date"
                  value="<?php echo e($oldFormData['date'] ?? date("Y-m-d")); ?>" />
                <?php if (array_key_exists('date', $errors)) : ?>
                  <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo e($errors['date'][0]); ?>
                  </div>
                <?php endif; ?>
              </div>

              <div class="col-md-5">
                <label class="form-label">Sposób płatności</label>
                <select class="form-select" required="" name="paymentMethod">
                  <?php foreach ($userPaymentMethods as $userPaymentMethod) : ?>
                    <option value="<?php echo e($userPaymentMethod['id']); ?>"><?php echo e($userPaymentMethod['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-4">
                <label for="state" class="form-label">Kategoria</label>
                <select class="form-select" id="state" required="" name="expenseCategory">
                  <?php foreach ($userExpenseCategories as $userExpenseCategory) : ?>
                    <option value="<?php echo e($userExpenseCategory['id']); ?>"><?php echo e($userExpenseCategory['name']); ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Wybierz jedną z opcji</div>
              </div>
            </div>

            <div class="form-group py-5">
              <label for="address" class="form-label">Komentarz(opcjonalnie)</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
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