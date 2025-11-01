<?php include $this->resolve("partials/_header.php"); ?>

<body>

  <?php include $this->resolve("partials/_navbar.php"); ?>

  <div class="container">
    <main>
      <div class="py-5 text-center">
        <h1>Dodaj wydatek</h1>
      </div>

      <?php if (isset($_SESSION['success'])) : ?>
        <div class="action-status">
          <p class="success">Wydatek został pomyślnie dodany!</p>
        </div>
      <?php unset($_SESSION['success']);
      endif; ?>

      <!-- Komunikat o limicie -->
      <div id="limitAlert" class="action-status" style="display: none;">
        <p id="limitMessage"></p>
      </div>

      <div class="row g-5">
        <div class="col-md-12 col-lg-12 text-center">
          <h2 class="mb-3">Szczegóły transakcji</h2>
          <form class="needs-validation" novalidate="" method="post">
            <?php include $this->resolve('partials/_csrf.php'); ?>
            <div class="row g-3 d-flex justify-content-center">
              <div class="col-xs-12 col-sm-3">
                <label for="address" class="form-label">Kwota</label>
                <div class="input-group">
                  <input type="number"
                    min="0"
                    step="5"
                    class="form-control"
                    aria-label="Cash amount (with dot and two decimal places)"
                    name="amount"
                    id="amountInput"
                    value="<?php echo e($oldFormData['amount'] ?? ''); ?>" />
                  <span class="input-group-text">zł</span>
                </div>
                <?php if (array_key_exists('amount', $errors)) : ?>
                  <span class='error'>
                    <?php echo e($errors['amount'][0]); ?>
                  </span>
                <?php endif; ?>
              </div>

              <div class="col-xs-12 col-sm-3">
                <label for="address2" class="form-label">Data transakcji</label>
                <input id="startDate"
                  class="form-control"
                  type="date"
                  name="date"
                  value="<?php echo e($oldFormData['date'] ?? date("Y-m-d")); ?>" />
                <?php if (array_key_exists('date', $errors)) : ?>
                  <span class='error'>
                    <?php echo e($errors['date'][0]); ?>
                  </span>
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
                <select class="form-select" id="expenseCategorySelect" required="" name="expenseCategory">
                  <?php foreach ($userExpenseCategories as $userExpenseCategory) : ?>
                    <option value="<?php echo e($userExpenseCategory['id']); ?>"><?php echo e($userExpenseCategory['name']); ?></option>
                  <?php endforeach; ?>
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

    <script>
      // Debounce function - zapobiega nadmiernemu wywoływaniu API
      function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
          const later = () => {
            clearTimeout(timeout);
            func(...args);
          };
          clearTimeout(timeout);
          timeout = setTimeout(later, wait);
        };
      }

      // Funkcja sprawdzająca limit
      async function checkExpenseLimit(amount) {
        // Jeśli kwota jest pusta lub zero, ukryj komunikat
        if (!amount || parseFloat(amount) <= 0) {
          document.getElementById('limitAlert').style.display = 'none';
          return;
        }

        // Pobierz ID wybranej kategorii
        const categorySelect = document.getElementById('expenseCategorySelect');
        const categoryId = categorySelect ? categorySelect.value : null;

        if (!categoryId) {
          console.warn('Brak wybranej kategorii');
          return;
        }

        try {
          // Pobierz dane z API z categoryId jako parametr
          const response = await fetch(`/api/expense-limits/${categoryId}`, {
            method: 'GET',
            headers: {
              'Content-Type': 'application/json',
            }
          });

          console.log(response);

          if (!response.ok) {
            throw new Error('Błąd pobierania danych limitu');
          }

          const data = await response.json();

          // API zwraca: { monthlyLimit: 5000, usedAmount: 3000 }
          const monthlyLimit = parseFloat(data.expense_limit);
          const usedAmount = parseFloat(data.limit_used);
          const newAmount = parseFloat(amount);
          const totalAfterExpense = usedAmount + newAmount;

          const limitAlert = document.getElementById('limitAlert');
          const limitMessage = document.getElementById('limitMessage');

          // Pokaż komunikat
          limitAlert.style.display = 'flex';

          console.log(monthlyLimit);

          // Sprawdź czy przekraczamy limit
          if (Number.isNaN(monthlyLimit) || monthlyLimit === 0) {
            const excess = (totalAfterExpense - monthlyLimit).toFixed(2);
            limitMessage.textContent = `⚠️ UWAGA! Miesięczny limit nie został ustalony!`;
            limitMessage.className = 'error';
          } else if (totalAfterExpense > monthlyLimit) {
            const excess = (totalAfterExpense - monthlyLimit).toFixed(2);
            limitMessage.textContent = `⚠️ UWAGA! Po dodaniu tego wydatku przekroczysz miesięczny limit o ${excess} zł (Limit: ${monthlyLimit.toFixed(2)} zł, Wykorzystano: ${usedAmount.toFixed(2)} zł)`;
            limitMessage.className = 'error';
          } else {
            const remaining = (monthlyLimit - totalAfterExpense).toFixed(2);
            const percentUsed = ((totalAfterExpense / monthlyLimit) * 100).toFixed(1);

            if (percentUsed >= 90) {
              limitMessage.textContent = `⚠️ Uwaga! Po dodaniu tego wydatku wykorzystasz ${percentUsed}% limitu. Pozostanie: ${remaining} zł`;
              limitMessage.className = 'warning';
              limitMessage.style.color = '#FFB000';
              limitMessage.style.fontWeight = 'bolder';
              limitMessage.style.fontSize = '1.5rem';
            } else {
              limitMessage.textContent = `✓ Wydatek mieści się w limicie. Po dodaniu pozostanie: ${remaining} zł (Wykorzystane: ${percentUsed}%)`;
              limitMessage.className = 'success';
            }
          }

        } catch (error) {
          console.error('Błąd podczas sprawdzania limitu:', error);
          // Opcjonalnie można wyświetlić komunikat o błędzie
          document.getElementById('limitAlert').style.display = 'none';
        }
      }

      // Debounced version - czeka 500ms po ostatnim wpisaniu znaku
      const debouncedCheckLimit = debounce(checkExpenseLimit, 500);

      // Nasłuchuj na zmiany w polu amount i kategorii
      document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('amountInput');
        const categorySelect = document.getElementById('expenseCategorySelect');

        if (amountInput) {
          // Sprawdź przy ładowaniu strony jeśli jest wartość
          if (amountInput.value) {
            checkExpenseLimit(amountInput.value);
          }

          // Sprawdzaj przy każdej zmianie kwoty
          amountInput.addEventListener('input', function(e) {
            debouncedCheckLimit(e.target.value);
          });

          // Sprawdź też przy załadowaniu (dla przypadku gdy wartość jest z PHP)
          amountInput.addEventListener('change', function(e) {
            checkExpenseLimit(e.target.value);
          });
        }

        // Nasłuchuj na zmianę kategorii
        if (categorySelect) {
          categorySelect.addEventListener('change', function() {
            const amount = amountInput ? amountInput.value : null;
            if (amount && parseFloat(amount) > 0) {
              checkExpenseLimit(amount);
            }
          });
        }
      });
    </script>