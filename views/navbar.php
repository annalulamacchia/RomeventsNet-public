<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand m-2" type="button" href="index.php">
      <img src="..\imgs\icons\coliseum_128px.png" alt="" width="40" height="40"
        class="d-inline-block align-text-center"> RomeventsNet
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-auto">
          <ul class="input-group w-auto">
            <form class="d-flex" name="search" method="GET" action="../form_action/search.php"
              enctype="multipart/form-data">
              <input type="search" name="nome" class="form-control rounded form-control-lg pe-sm-5"
                placeholder="Ricerca artisti o eventi" aria-label="Search" aria-describedby="search-addon" />
              <button type="submit" class="btn" id="search" name="cerca">
                <img src="../imgs/icons/search.png" height="25px" width="25px">
              </button>
            </form>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item dropdown m-2">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
            data-bs-toggle="dropdown" aria-expanded="false"> Menu
          </a>
          <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDarkDropdownMenuLink">
            <li>
              <a class="dropdown-item" type="button" href="concerti.php"> Concerti </a>
            </li>
            <li>
              <a class="dropdown-item" type="button" href="mostre.php"> Mostre </a>
            </li>
            <li>
              <a class="dropdown-item" type="button" href="teatri.php"> Spettacoli Teatrali </a>
            </li>
            <li>
              <a class="dropdown-item" type="button" href="eventi_proposti.php"> Eventi proposti da voi </a>
            </li>
            <li>
              <a class="dropdown-item" type="button" href="form_compagno.php"> Trova un amico </a>
            </li>
            <li>
              <a class="dropdown-item" type="button" href="form_invia_evento.php"> Invia un evento </a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="nav-item p-0 m-2">
        <?php if (isset($_SESSION['session_id'])) {
          ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="../imgs/icons/user.png" class="align-text-top" height="22px" width="22px">
              </a>
              <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDarkDropdownMenuLink">
                <li>
                  <a class="dropdown-item" type="button" href="home.php"> Il tuo profilo </a>
                </li>
                <li>
                  <a class="dropdown-item" href="logout.php"> Logout
                  </a>
                </li>
              </ul>
          </ul>
          <?php
        } else {
          ?>
          <ul class="nav-item p-0">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link m-2" id="iscriviti" href="iscriviti.php">Iscriviti</a>
              </li>
              <li class="nav-item">
                <a class="nav-link m-2" href="login.php">Login</a>
              </li>
            </ul>
          </ul>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>