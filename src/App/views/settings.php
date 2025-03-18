<?php include $this->resolve("partials/_header.php"); ?>



<body>

      <?php include $this->resolve("partials/_navbar.php"); ?>

      <div class="container">
            <div>
                  <div class="py-5 text-center">
                        <h6>Kategorie Przychodów</h6>
                  </div>
                  <div class="flex-justify-content"><button class="w-100 btn btn-primary btn-lg">
                              Dodaj
                        </button>
                        <button class="w-100 btn btn-primary btn-lg">
                              Edytuj
                        </button>
                        <button class="w-100 btn btn-primary btn-lg">
                              Usuń
                        </button>
                  </div>
            </div>
            <div>
                  <div class="py-5 text-center">
                        <h6>Kategorie Wydatków</h6>
                  </div>

                  <button class="w-100 btn btn-primary btn-lg">
                        Dodaj
                  </button>
                  <button class="w-100 btn btn-primary btn-lg">
                        Edytuj
                  </button>
                  <button class="w-100 btn btn-primary btn-lg">
                        Usuń
                  </button>
            </div>
            <div>
                  <div class="py-5 text-center">
                        <h6>Kategorie Metod Płatności</h6>
                  </div>

                  <button class="w-100 btn btn-primary btn-lg">
                        Dodaj
                  </button>
                  <button class="w-100 btn btn-primary btn-lg">
                        Edytuj
                  </button>
                  <button class="w-100 btn btn-primary btn-lg">
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

      <?php include $this->resolve("partials/_footer.php"); ?>