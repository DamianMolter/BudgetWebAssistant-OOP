<?php include $this->resolve("partials/_header.php"); ?>

<body>

      <?php include $this->resolve("partials/_navbar.php"); ?>

      <div class="container">
            <main>
                  <div class="py-5 text-center">
                        <h1>Dodaj kategorię wydatku</h1>
                  </div>

                  <div class="row g-5">
                        <div class="col-md-12 col-lg-12 text-center">
                              <h4 class="mb-3">Wprowadź żadaną nazwę kategorii:</h4>
                              <form class="needs-validation" novalidate="" method="post">
                                    <?php include $this->resolve('partials/_csrf.php'); ?>
                                    <div class="row g-3 d-flex justify-content-center">

                                          <div class="col-xs-12 col-sm-3">
                                                <input
                                                      class="form-control"
                                                      type="text"
                                                      name="addExpenseCategory" />
                                                <?php if (array_key_exists('date', $errors)) : ?>
                                                      <span class='error'>
                                                            <?php echo e($errors['date'][0]); ?>
                                                      </span>
                                                <?php endif; ?>
                                          </div>
                                    </div>
                                    </br>
                                    <button class="w-100 btn btn-primary btn-lg" type="submit">
                                          Dodaj
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