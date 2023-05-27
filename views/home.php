<?php
session_start();
include '../db/db_utenti_config.php';
?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet"
    href="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\css\bootstrap.css" />
  <script src="..\bootstrap\bootstrap-5.3.0-alpha2-dist\bootstrap-5.3.0-alpha2-dist\js\bootstrap.bundle.js"
    type="application/javascript"></script>
  <link rel="stylesheet" href="..\css\col-xs.css">
  <link rel="stylesheet" href="..\css\style.css">
  <link rel="stylesheet" href="..\css\form.css">
  <link rel="stylesheet" href="..\css\dashboard.css">
  <script src="../js/jquery-3.6.4.js"></script>
  <title>RomeventsNet</title>
  <link rel="icon" type="image/x-icon" href="..\imgs\icons\coliseum_24px.png">
</head>

<body>
  <?php
  $utente = $_SESSION['session_user'];
  $sql = "SELECT* FROM Utenti WHERE Utenti.username='$utente'";
  $res = $db->query($sql);
  $row = $res->fetch();
  ?>
  <nav class="navbar navbar-light p-3">
    <div
      class="col-sm-5 col-md-4 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap flex-sm-nowrap justify-content-between">
      <button class="navbar-toggler d-md-none align-content-start border-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
        <img class="" src="../imgs/icons/coliseum_128px.png" alt="" width="40px" height="40px"></img>
      </button>
      <a class="navbar-brand" type="button" id="buttonIndex">
        <img src="..\imgs\icons\coliseum_128px.png" alt="" width="40px" height="40px"
          class="d-md-inline-block d-lg-inline-block align-text-center d-sm-none d-xs-none"> RomeventsNet
      </a>
    </div>
    <div class="col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end me-2">
      <ul class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <img src="../imgs/icons/user.png" height="22px" width="22px">
        </a>
        <ul
          class="dropdown-menu dropdown-menu-light dropdown-menu-xs-end dropdown-menu-sm-end dropdown-menu-md-end dropdown-menu-lg-end"
          aria-labelledby="navbarDarkDropdownMenuLink">
          <li>
            <div class="dropdown-item" type="button" id="buttonHome">
              Il tuo profilo </div>
          </li>
          <li>
            <a class="dropdown-item" href="logout.php"> Logout
            </a>
          </li>
        </ul>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
        <div class="position-relative">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active link1" aria-current="page" href="home.php" id="homeButton">
                <div class="row">
                  <div class="col-2 mx-auto my-auto">
                    <img src="../imgs/icons/home1.png" height="26px" width="26px">
                  </div>
                  <div class="col-10 mx-auto my-auto">
                    <span>Il tuo profilo</span>
                  </div>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link1" id="iscritto_profilo">
                <div class="row">
                  <div class="col-2 mx-auto my-auto">
                    <img src="../imgs/icons/event.png" height="26px" width="26px">
                  </div>
                  <div class="col-10 mx-auto my-auto">
                    <span>Eventi a cui sei iscritto</span>
                  </div>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link1" id="eventi_profilo">
                <div class="row">
                  <div class="col-2 mx-auto my-auto">
                    <img src="../imgs/icons/calendar.png" height="26px" width="26px">
                  </div>
                  <div class="col-10 mx-auto my-auto">
                    <span>Eventi proposti da te</span>
                  </div>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link link1" id="compagni_profilo">
                <div class="row">
                  <div class="col-2 mx-auto my-auto">
                    <img src="../imgs/icons/friends.png" height="26px" width="26px">
                  </div>
                  <div class="col-10 mx-auto my-auto">
                    <span>Persone interessate ai tuoi stessi eventi</span>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main
        class="col-md-9 ml-sm-auto mx-auto col-lg-10 p-3 text-lg-start text-md-start text-sm-start text-xs-center text-xxs-center"
        id="zonaDinamica">
        <h3 class="text-start">Il tuo profilo</h3>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
          <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
          </symbol>
          <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
              d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
          </symbol>
        </svg>
        <?php
        //controlla se session 'error' è settato se username o email sono già nel database
        if (isset($_SESSION['error'])) {
          ?>
          <!--Mostra l'errore -->
          <div class="text-center">
            <div class="alert alert-danger d-inline-flex alert-dismissible fade show align-items-center" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
              </svg>
              <div>
                <?php
                echo $_SESSION['error'];
                ?>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
          <?php
          //Unsetting 'error' session dopo aver mostrato l'errore 
          unset($_SESSION['error']);
        }
        ?>
        <?php
        //controlla se session 'success' è settato quando un account è creato con successo
        if (isset($_SESSION['success'])) {
          ?>
          <!-- Mostra il messaggio -->
          <div class="text-center">
            <div class="alert alert-success d-inline-flex align-items-center alert-dismissible fade show" role="alert">
              <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
              </svg>
              <div>
                <?php
                echo $_SESSION['success'];
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
            <?php
            //Unsetting 'success' session dopo aver mostrato il messaggio
            unset($_SESSION['success']);
        }
        ?>
          <div class="text-center">
            <div id="cambia_img">
              <div class="picture">
                <img src="<?php echo $row['image']; ?>" class="picture-src" name="imagePrev" id="imagePreview" title="">
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
                <div type="button" class="button2" id="canc" onclick="return clearImage();">
                  <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2"
                    stroke="#FFFFFF" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                  </svg>
                </div>
              </div>
            </div>
            <input type="text" name="nome" class="input" placeholder="Nome" value="<?php echo $row['nome']; ?>"
              readonly> <br>
            <input type="text" name="nome" class="input" placeholder="Nome" value="<?php echo $row['cognome']; ?>"
              readonly> <br>
            <input type="text" name="nome" class="input" placeholder="Nome" value="<?php echo $row['username']; ?>"
              readonly> <br>
            <input type="text" name="nome" class="input" placeholder="Nome" value="<?php echo $row['email']; ?>"
              readonly> <br> <br>
            <button class="button1" id="mod_prof"> Modifica </button>
            <button class="noselect button" id="del_prof" data-bs-target="#staticBackdrop" data-bs-toggle="modal"><span
                class="text">Elimina</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" viewBox="0 0 24 24">
                  <path
                    d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z">
                  </path>
                </svg></span></button>
            <div class="modal fade modal1-lg modal1-md modal1-sm modal1-xs modal1-xxs" id="staticBackdrop"
              data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-center" id="staticBackdropLabel">Vuoi davvero eliminare il tuo profilo?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <form name="form_elimina_profilo" method="POST" action="../form_action/delete.php"
                      class="form-signin row g-2 mx-auto" enctype="multipart/form-data">
                      <div class="row text-center">
                        <div class="col-lg-6">
                          <button class="enter" type="submit" name="elimina" id="elimina">SI</button>
                        </div>
                        <div class="col-lg-6">
                          <button class="enter" type="submit" name="indietro" id="indietro">NO</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  </main>
  </div>
  </div>
  </div>

  <!--Caricamento asincrono-->
  <script>
    $(document).ready(function () {
      $("#mod_prof").click(function () {
        $("#zonaDinamica").load("modifica_profilo.php");
      });
      $("#eventi_profilo").click(function () {
        $("#zonaDinamica").load("eventi_profilo.php");
        $(this).addClass("active");
        $("#homeButton").removeClass("active");
        $("#compagni_profilo").removeClass("active");
        $("#iscritto_profilo").removeClass("active");
      });
      $("#compagni_profilo").click(function () {
        $("#zonaDinamica").load("compagni_profilo.php");
        $(this).addClass("active");
        $("#homeButton").removeClass("active");
        $("#iscritto_profilo").removeClass("active");
        $("#eventi_profilo").removeClass("active");
      });
      $("#iscritto_profilo").click(function () {
        $("#zonaDinamica").load("iscritto_profilo.php");
        $(this).addClass("active");
        $("#homeButton").removeClass("active");
        $("#eventi_profilo").removeClass("active");
        $("#compagni_profilo").removeClass("active");
      });
      $("#buttonIndex").click(function () {
        window.location.assign("index.php");
      });
      $("#buttonHome").click(function () {
        window.location.assign("home.php");
      });
      $("#buttonLogout").click(function () {
        window.location.assign("index.php");
      });
      $("#canc").click(function () {
        $("#cambia_img").load("cambia_img.php");
      })
    });
  </script>
</body>
<?php include 'footer.html'; ?>

</html>