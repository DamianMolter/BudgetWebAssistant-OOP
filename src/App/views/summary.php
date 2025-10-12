<?php include $this->resolve("partials/_header.php"); ?>

<body>

  <?php include $this->resolve("partials/_navbar.php"); ?>

  <header>
    <div class="text-center pt-5">
      <h1>Witaj <?php echo $userName; ?>, oto twój Bilans za okres: <?php echo $chosenPeriod; ?></h1>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Niestandardowy
        </button>
        <ul class="dropdown-menu">
          <li><a class="nav-link py-3" href="/summary">Bieżący miesiąc</a></li>
          <li><a class="nav-link py-3" href="/summary/previous-month">Poprzedni miesiąc</a></li>
          <li><a class="nav-link py-3" href="/summary/current-year">Bieżący rok</a></li>
          <li>
            <a class="nav-link py-3" href="#" data-bs-toggle="modal" data-bs-target="#customPeriod">Okres
              niestandardowy</a>
          </li>
        </ul>
      </div>

      <div class="modal fade" id="customPeriod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title fs-5" id="exampleModalLabel">
                Wybierz przedział czasowy
              </h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
              <?php include $this->resolve('partials/_csrf.php'); ?>
              <div class="modal-body">
                <div>
                  <h5>Początek okresu:</h5>
                  <input id="startDate"
                    class="form-control"
                    type="date"
                    name="beginDate"
                    value="<?php echo e($_SESSION['beginDate'] ?? date('Y-m-d'));
                            unset($_SESSION['begindDate']); ?>" />
                </div>
                <div>
                  <h5>Koniec okresu:</h5>
                  <input id="endDate"
                    class="form-control"
                    type="date"
                    name="endDate"
                    value="<?php echo e($_SESSION['endDate'] ?? date('Y-m-d'));
                            unset($_SESSION['endDate']); ?>" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                  Anuluj
                </button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                  Akceptuj
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container table">
      <div class="text-center">
        <h2>Tabela przychodów</h2>
        <table class="table table-hover">
          <tr class="odd-row col-title">
            <td>Kategoria</td>
            <td>Kwota (PLN)</td>
          </tr>
          <?php
          $incomeCategoriesSum = 0;
          $oddOrEven = true;
          foreach ($userIncomes as $userIncome) : ?>
            <?php if ($oddOrEven) : ?>
              <tr class="even-row">
                <td class="icategory"> <?php echo $userIncome['name']; ?></td>
                <td class="icategory-amount"><?php echo $userIncome['amountSum']; ?> </td>
              </tr>
              <?php $oddOrEven = !$oddOrEven;
              $incomeCategoriesSum += $userIncome['amountSum']; ?>
            <?php else: ?>
              <tr class="odd-row">
                <td class="icategory"><?php echo $userIncome['name']; ?></td>
                <td class="icategory-amount"> <?php echo $userIncome['amountSum']; ?></td>
              </tr>
            <?php $oddOrEven = !$oddOrEven;
              $incomeCategoriesSum += $userIncome['amountSum'];
            endif; ?>

          <?php endforeach; ?>

          <?php if (!$oddOrEven): ?>
            <tr class="odd-row col-title">
            <?php else: ?>
            <tr class="even-row col-title">
            <?php endif; ?>
            <td>Suma</td>
            <td><?php echo $incomeCategoriesSum; ?></td>
            </tr>

        </table>
      </div>
      <div class="text-center">
        <h2>Tabela Wydatków</h2>
        <table class="table table-hover">
          <tr class="odd-row col-title">
            <td>Kategoria</td>
            <td>Kwota (PLN)</td>
          </tr>
          <?php
          $oddOrEven = true;
          $expenseCategoriesSum = 0;
          foreach ($userExpenses as $userExpense) : ?>
            <?php if ($oddOrEven) : ?>
              <tr class="even-row">
                <td class="ecategory"> <?php echo $userExpense['name']; ?></td>
                <td class="ecategory-amount"><?php echo $userExpense['amountSum']; ?> </td>
              </tr>
              <?php $oddOrEven = !$oddOrEven;
              $expenseCategoriesSum += $userExpense['amountSum']; ?>
            <?php else: ?>
              <tr class="odd-row">
                <td class="ecategory"><?php echo $userExpense['name']; ?></td>
                <td class="ecategory-amount"> <?php echo $userExpense['amountSum']; ?></td>
              </tr>
            <?php $oddOrEven = !$oddOrEven;
              $expenseCategoriesSum += $userExpense['amountSum'];
            endif; ?>
          <?php endforeach; ?>
          <?php if (!$oddOrEven): ?>
            <tr class="odd-row col-title">
            <?php else: ?>
            <tr class="even-row col-title">
            <?php endif; ?>
            <td>Suma</td>
            <td><?php echo $expenseCategoriesSum; ?></td>
            </tr>
        </table>
        <div class="table"></div>
      </div>
    </div>
    <?php $finalBalance = $incomeCategoriesSum - $expenseCategoriesSum; ?>
    <div class="container text-center py-5">
      <h6>
        Twój bilans wynosi <?php echo $finalBalance; ?> PLN!
        <?php
        if ($finalBalance >= 0) {
          echo 'Gratulacje! Doskonale zarządzasz swoimi finansami!';
        } else {
          echo 'Musisz popracować nad zarządzaniem finansami!';
        }
        ?>
      </h6>
    </div>
    <div class="demo-container">
      <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#aiAssist">Wskazówka od e-doradcy</button>
    </div>

    <div class="modal fade" id="aiAssist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title fs-5" id="exampleModalLabel">
              Rada od Twojego doradcy finansowego
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p id="advice"></p>
          </div>
        </div>
      </div>
    </div>


  </main>


  <hr />
  <aside>
    <div class="container chart d-flex justify-content-center">
      <canvas id="incomesChart" style="width:100%;max-width:700px"></canvas>
      <canvas id="expensesChart" style="width:100%;max-width:700px"></canvas>
      <script>
        const barColors = ["red", "green", "blue", "orange", "brown"];
        const incomeCategories = document.querySelectorAll("td.icategory");
        const incomeAmounts = document.querySelectorAll("td.icategory-amount");
        const incomeLength = incomeCategories.length;
        var incomeNames = [];
        var incomeValues = [];
        var singleIncomeName = 0
        var singleIncomeValue = 0;
        for (var i = 0; i < incomeLength; i++) {
          var singleIncomeName = incomeCategories[i].textContent;
          var singleIncomeValue = incomeAmounts[i].textContent;
          incomeNames.push(singleIncomeName);
          incomeValues.push(singleIncomeValue);
        }

        const expenseCategories = document.querySelectorAll("td.ecategory");
        const expenseAmounts = document.querySelectorAll("td.ecategory-amount");
        const expenseLength = expenseCategories.length;
        var expenseNames = [];
        var expenseValues = [];
        var singleExpenseName = 0
        var singleExpenseValue = 0;
        for (var i = 0; i < expenseLength; i++) {
          var singleExpenseName = expenseCategories[i].textContent;
          var singleExpenseValue = expenseAmounts[i].textContent;
          expenseNames.push(singleExpenseName);
          expenseValues.push(singleExpenseValue);
        }

        let advice = document.getElementById("advice");
        advice = async () => {
          try {
            // Pobierz dane z API z categoryId jako parametr
            const response = await fetch(`/advise`, {
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
          } catch (error) {
            console.error('Błąd podczas sprawdzania limitu:', error);
            // Opcjonalnie można wyświetlić komunikat o błędzie
            document.getElementById('limitAlert').style.display = 'none';
          }
        }



        new Chart("incomesChart", {
          type: "pie",
          data: {
            labels: incomeNames,
            datasets: [{
              backgroundColor: barColors,
              data: incomeValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Twoje przychody"
            }
          }
        })

        new Chart("expensesChart", {
          type: "pie",
          data: {
            labels: expenseNames,
            datasets: [{
              backgroundColor: barColors,
              data: expenseValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Twoje wydatki"
            }
          }
        });
      </script>



    </div>
  </aside>
  <?php include $this->resolve("partials/_footer.php"); ?>