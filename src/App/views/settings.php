<?php include $this->resolve("partials/_header.php"); ?>

<body>

      <?php include $this->resolve("partials/_navbar.php"); ?>

      <div class="container">
            <div>
                  <div class="py-5 text-center">
                        <h6>Kategorie Przychodów</h6>

                        <?php if (array_key_exists('password', $errors)) : ?>
                              <span class='error'>
                                    <?php echo e($errors['password'][0]); ?>
                              </span>
                        <?php endif; ?>
                  </div>
                  <div class="flex-justify-content">
                        <a href="/settings/add-income-category">
                              <button
                                    class="w-100 btn btn-primary btn-lg">
                                    Dodaj
                              </button></a>

                        <a href="/settings/edit-income-category">
                              <button
                                    class="w-100 btn btn-primary btn-lg">
                                    Edytuj
                              </button></a>
                        <a href="/settings/delete-income-category">
                              <button
                                    class="w-100 btn btn-primary btn-lg">
                                    Usuń
                              </button></a>
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
                  <a href="/settings/edit-expense-category">
                        <button
                              class="w-100 btn btn-primary btn-lg">
                              Edytuj
                        </button></a>
                  <a href="/settings/delete-expense-category">
                        <button
                              class="w-100 btn btn-primary btn-lg">
                              Usuń
                        </button></a>
                  <a href="/settings">
                        <button
                              class="w-100 btn btn-primary btn-lg">
                              Ustaw Limity Wydatków
                        </button></a>
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
                  <a href="/settings/edit-payment-method">
                        <button
                              class="w-100 btn btn-primary btn-lg">
                              Edytuj
                        </button></a>
                  <a href="/settings/delete-payment-method">
                        <button
                              class="w-100 btn btn-primary btn-lg">
                              Usuń
                        </button></a>
            </div>

            <div>
                  <div class="py-5 text-center">
                        <h6>Twoje konto</h6>
                  </div>
                  <div>
                        <a href="/settings/user-account-settings">
                              <button class="w-100 btn btn-primary btn-lg">
                                    Zmień ustawienia konta
                              </button></a>
                  </div>

                  <div>
                        <button class="w-100 btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#deleteAccount">
                              Usuń konto
                        </button>
                  </div>

                  <div class="modal fade" id="deleteAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <h5 class="modal-title fs-5" id="exampleModalLabel">
                                                Usuwanie konta
                                          </h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                          <?php include $this->resolve('partials/_csrf.php'); ?>
                                          <div class="modal-body">
                                                <div>

                                                      <h4>Czy jesteś pewien?</h4>
                                                      <span class="warning">Usunięcie konta spowoduje bezpowrotne usunięcie wszystkich Twoich transakcji oraz ustawień!
                                                            <br />
                                                            Jeżeli jednak jesteś pewien tej decyzji, wpisz poniżej swoje hasło i kliknij przycisk &quotPotwierdź&quot:
                                                      </span>
                                                      <br />
                                                      <input class="form-control"
                                                            type="password"
                                                            name="password" />
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

      </div>

      <?php include $this->resolve("partials/_settings-modals.php"); ?>

      <?php include $this->resolve("partials/_footer.php"); ?>