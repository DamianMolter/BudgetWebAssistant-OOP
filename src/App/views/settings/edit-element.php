<?php

use function PHPSTORM_META\elementType;

include $this->resolve("partials/_header.php"); ?>



<body>

      <?php include $this->resolve("partials/_navbar.php"); ?>

      <div class="container">
            <main>
                  <div class="py-5 text-center">
                        <h2>Edytuj <?php echo $elementName; ?></h2>
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

                                          <div class="col-xs-12 col-sm-3">
                                                <h4 class="mb-3">Wprowadź żądaną nazwę:</h4>
                                                <input
                                                      class="form-control"
                                                      type="text"
                                                      name="newName"
                                                      value="<?php echo e($oldFormData['newName'] ?? ""); ?>" />
                                                <?php if (array_key_exists('newName', $errors)) : ?>
                                                      <span class='error'>
                                                            <?php echo e($errors['newName'][0]); ?>
                                                      </span>
                                                <?php endif; ?>
                                          </div>



                                          <div class="col-xs-12 col-md-4">
                                                <h4 class="mb-3">Wybierz kategorię do zmiany</h4>
                                                <select class="form-select" id="state" required="" name="oldElementId">
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