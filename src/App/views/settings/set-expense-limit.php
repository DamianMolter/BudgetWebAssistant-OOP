<?php

use function PHPSTORM_META\elementType;

include $this->resolve("partials/_header.php"); ?>



<body>

      <?php include $this->resolve("partials/_navbar.php"); ?>

      <div class="container">
            <main>
                  <div class="py-5 text-center">
                        <h2>Ustaw limity wydatków</h2>
                  </div>


                  <?php if (isset($_SESSION['success'])) : ?>
                        <div class="action-status">
                              <p class="success">Zmiana została pomyślnie dokonana!</p>
                        </div>
                  <?php unset($_SESSION['success']);
                  endif; ?>


                  <div class="row g-5">
                        <div class="col-md-12 col-lg-12 text-center">
                              <form class="needs-validation" novalidate="" method="post">
                                    <?php include $this->resolve('partials/_csrf.php'); ?>
                                    <div class="row g-3 d-flex justify-content-center">

                                          <div class="col-xs-12 col-md-4">
                                                <h4 class="mb-3">Wybierz kategorię</h4>
                                                <select class="form-select" id="state" required="" name="expenseCategoryId">
                                                      <?php foreach ($userElementNames as $userElementName) : ?>
                                                            <option value="<?php echo e($userElementName['id']); ?>">
                                                                  <?php echo e($userElementName['name']); ?>
                                                            </option>
                                                      <?php endforeach; ?>
                                                </select>
                                                <?php if (array_key_exists('incomeCategory', $errors)) : ?>
                                                      <span class='error'>
                                                            <?php echo e($errors['date'][0]); ?>
                                                      </span>
                                                <?php endif; ?>
                                          </div>

                                          <div class="col-xs-12 col-sm-3">
                                                <h4 class="mb-3">Wprowadź swój limit:</h4>
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
                                                      <span class='error'>
                                                            <?php echo e($errors['amount'][0]); ?>
                                                      </span>
                                                <?php endif; ?>
                                          </div>
                                    </div>
                                    <br />

                                    <button class="w-100 btn btn-primary btn-lg" type="submit">
                                          Zapisz
                                    </button>
                              </form>
                              <a href="/settings">
                                    <button class="w-100 btn btn-secondary btn-lg">
                                          Powrót
                                    </button>
                              </a>
                        </div>
                  </div>
            </main>

            <?php include $this->resolve("partials/_footer.php"); ?>