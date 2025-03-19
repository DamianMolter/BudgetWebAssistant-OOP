<?php include $this->resolve("partials/_header.php"); ?>

<body>

      <?php include $this->resolve("partials/_navbar.php"); ?>

      <div class="container">
            <div>
                  <div class="py-5 text-center">
                        <h6>Kategorie Przychodów</h6>
                  </div>
                  <div class="flex-justify-content">
                        <a href="/settings/add-income-category">
                              <button
                                    class="w-100 btn btn-primary btn-lg">
                                    Dodaj
                              </button></a>

                        <button
                              class="w-100 btn btn-primary btn-lg"
                              data-bs-toggle="modal"
                              data-bs-target="#edit-income-category">
                              Edytuj
                        </button>
                        <button
                              class="w-100 btn btn-primary btn-lg"
                              data-bs-toggle="modal"
                              data-bs-target="#delete-income-category">
                              Usuń
                        </button>
                  </div>
            </div>
            <div>
                  <div class="py-5 text-center">
                        <h6>Kategorie Wydatków</h6>
                  </div>

                  <a href="/settings/add-expense-category">
                        <button
                              class="w-100 btn btn-primary btn-lg">
                              Dodaj
                        </button></a>
                  <button
                        class="w-100 btn btn-primary btn-lg"
                        data-bs-toggle="modal"
                        data-bs-target="#edit-expense-category">
                        Edytuj
                  </button>
                  <button
                        class="w-100 btn btn-primary btn-lg"
                        data-bs-toggle="modal"
                        data-bs-target="#delete-expense-category">
                        Usuń
                  </button>
            </div>
            <div>
                  <div class="py-5 text-center">
                        <h6>Kategorie Metod Płatności</h6>
                  </div>

                  <a href="/settings/add-payment-method">
                        <button
                              class="w-100 btn btn-primary btn-lg">
                              Dodaj
                        </button></a>
                  <button
                        class="w-100 btn btn-primary btn-lg"
                        data-bs-toggle="modal"
                        data-bs-target="#edit-payment-method">
                        Edytuj
                  </button>
                  <button
                        class="w-100 btn btn-primary btn-lg"
                        data-bs-toggle="modal"
                        data-bs-target="#delete-payment-method">
                        Usuń
                  </button>
            </div>

            <div>
                  <div class="py-5 text-center">
                        <h6>Twoje konto</h6>
                  </div>
                  <div>
                        <button class="w-100 btn btn-primary btn-lg">
                              Zmień ustawienia konta
                        </button>
                  </div>

                  <div>
                        <button class="w-100 btn btn-primary btn-lg">
                              Usuń konto
                        </button>
                  </div>
            </div>

      </div>

      <?php include $this->resolve("partials/_settings-modals.php"); ?>

      <?php include $this->resolve("partials/_footer.php"); ?>