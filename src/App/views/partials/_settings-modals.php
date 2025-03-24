<div class="modal fade" id="add-income-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Dodaj Kategorię Przychodów
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Podaj nazwę:</h5>
                                    <input
                                          class="form-control"
                                          type="text"
                                          name="addIncomeCategory"
                                          value="" />
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

<div class="modal fade" id="edit-income-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Edytuj Kategorię Przychodów
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Wybierz kategorię:</h5>
                                    <select class="form-select" id="state" required="" name="incomeCategory">

                                    </select>
                              </div>

                              <div>
                                    <h5>Podaj nazwę:</h5>
                                    <input
                                          class="form-control"
                                          type="text"
                                          name="editIncomeCategory"
                                          value="" />
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

<div class="modal fade" id="delete-income-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Usuń Kategorię Przychodów
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Wybierz kategorię:</h5>
                                    <select class="form-select" id="state" required="" name="deleteIncomeCategory">
                                    </select>
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

<div class="modal fade" id="add-expense-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Dodaj Kategorię Wydatków
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Podaj nazwę:</h5>
                                    <input
                                          class="form-control"
                                          type="text"
                                          name="addExpenseCategory"
                                          value="" />
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

<div class="modal fade" id="edit-expense-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Edytuj Kategorię Wydatków
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Wybierz kategorię:</h5>
                                    <select class="form-select" id="state" required="" name="expenseCategory">

                                    </select>
                              </div>

                              <div>
                                    <h5>Podaj nazwę:</h5>
                                    <input
                                          class="form-control"
                                          type="text"
                                          name="editExpenseCategory"
                                          value="" />
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

<div class="modal fade" id="delete-expense-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Usuń Kategorię Wydatków
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Wybierz kategorię:</h5>
                                    <select class="form-select" id="state" required="" name="deleteExpenseCategory">
                                    </select>
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

<div class="modal fade" id="add-payment-method" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Dodaj Metodę Płatności
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Podaj nazwę:</h5>
                                    <input
                                          class="form-control"
                                          type="text"
                                          name="addPaymentMethod"
                                          value="" />
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

<div class="modal fade" id="edit-payment-method" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Edytuj Metodę Płatności
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Wybierz kategorię:</h5>
                                    <select class="form-select" id="state" required="" name="incomeCategory">

                                    </select>
                              </div>

                              <div>
                                    <h5>Podaj nazwę:</h5>
                                    <input
                                          class="form-control"
                                          type="text"
                                          name="editPaymentMethod"
                                          value="" />
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

<div class="modal fade" id="delete-payment-method" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel">
                              Usuń Metodę Płatności
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="post">
                        <?php include $this->resolve('partials/_csrf.php'); ?>
                        <div class="modal-body">
                              <div>
                                    <h5>Wybierz kategorię:</h5>
                                    <select class="form-select" id="state" required="" name="deletePaymentMethod">
                                    </select>
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