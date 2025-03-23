<?php include $this->resolve("partials/_header.php"); ?>

<body>

      <?php include $this->resolve("partials/_navbar.php"); ?>

      <div class="container">
            <main>
                  <div class="py-5 text-center">
                        <h2>Zmień ustawienia konta</h2>
                  </div>


                  <?php if (isset($_SESSION['success'])) : ?>
                        <div class="action-status">
                              <p class="success">Zmiany zostały pomyślnie dokonane!</p>
                        </div>
                  <?php unset($_SESSION['success']);
                  endif; ?>


                  <div class="row g-5">
                        <div class="col-md-12 col-lg-12 text-center">
                              <h4 class="mb-3">Dane konta:</h4>
                              <form method="post">
                                    <?php include $this->resolve('partials/_csrf.php'); ?>
                                    <div class="row g-3 d-flex justify-content-center">
                                          <div class="col-sm-6 col-xl-4">
                                                <label for="address" class="form-label">Twoje imię:</label>
                                                <div class="input-group">
                                                      <input type="text"
                                                            class="form-control"
                                                            name="name"
                                                            value="<?php echo e($oldFormData['amount'] ?? ''); ?>" />
                                                </div>
                                                <?php if (array_key_exists('amount', $errors)) : ?>
                                                      <span class='error'>
                                                            <?php echo e($errors['amount'][0]); ?>
                                                      </span>
                                                <?php endif; ?>
                                          </div>
                                    </div>

                                    <div class="row g-3 d-flex justify-content-center">
                                          <div class="col-sm-6 col-xl-4">
                                                <label for="address" class="form-label">Adres email:</label>
                                                <div class="input-group">
                                                      <input type="text"
                                                            class="form-control"
                                                            name="email"
                                                            value="<?php echo e($oldFormData['amount'] ?? ''); ?>" />
                                                </div>
                                                <?php if (array_key_exists('amount', $errors)) : ?>
                                                      <span class='error'>
                                                            <?php echo e($errors['amount'][0]); ?>
                                                      </span>
                                                <?php endif; ?>
                                          </div>
                                    </div>


                                    <div class="row g-3 d-flex justify-content-center">
                                          <div class="col-sm-6 col-xl-4">
                                                <label for="address" class="form-label">Hasło:</label>
                                                <div class="input-group">
                                                      <input type="password"
                                                            class="form-control"
                                                            id="floatingPassword"
                                                            placeholder="Hasło"
                                                            name="password"
                                                            value="" />
                                                </div>


                                          </div>
                                    </div>


                                    <div class="row g-3 d-flex justify-content-center mb-5">
                                          <div class="col-sm-6 col-xl-4">
                                                <label for="address" class="form-label">Powtórz hasło:</label>
                                                <div class="input-group">
                                                      <input type="password"
                                                            class="form-control"
                                                            id="floatingPassword"
                                                            placeholder="Hasło"
                                                            name="confirmPassword"
                                                            value="" />

                                                </div>
                                                <?php if (array_key_exists('password', $errors)) : ?>
                                                      <span class='error'>
                                                            <?php echo e($errors['password'][0]); ?>
                                                      </span>
                                                <?php endif; ?>

                                          </div>
                                    </div>

                                    <button class="w-100 btn btn-primary btn-lg" type="submit">
                                          Zapisz
                                    </button>
                                    <button class="w-100 btn btn-secondary btn-lg" type="reset">
                                          Anuluj
                                    </button>
                              </form>

                        </div>
            </main>

            <?php include $this->resolve("partials/_footer.php"); ?>