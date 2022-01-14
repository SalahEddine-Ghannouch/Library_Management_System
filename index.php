<?php
session_start();
include "dbconnect.php";

if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die(mysql_error());
        if(mysqli_num_rows($result) > 0)
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['UserName'];
             print'
                <script type="text/javascript">alert("connecté avec succès !!!");</script>
                  ';
        }
        else
        {    print'
              <script type="text/javascript">alert("Identifiant ou mot de passe incorrect!!");</script>
                  ';
        }
  }
  else if($_POST['submit']=="register")
  {
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die(mysql_error);
        if(mysqli_num_rows($result)>0)
        {   
               print'
               <script type="text/javascript">alert("Le nom d utilisateur est pris");</script>
                    ';

        }
        else
        {
          $query ="INSERT INTO users VALUES ('$username','$password')";
          $result=mysqli_query($con,$query);
          print'
                <script type="text/javascript">
                 alert("Enregistré avec succès!!!");
                </script>
               ';
        }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <title>Bibliothéque | Lycée Prince Moulay Rachid</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
      .modal-header {background:#f98715;color:#fff;font-weight:800;}
      .modal-body{font-weight:800;}
      .modal-body ul{list-style:none;}
      .modal .btn {background:#f98715;color:#fff;}
      .modal a{color:#ff7a14;}
      .modal-backdrop {position:inherit !important;}
       #login_button,#register_button{background:none;color:#D67B22!important;}       
       #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;
                      background-color:#f98715;color:#fff;border-color:#f05f40;border-radius:2px;}
  	@media(max-width:767px){
        #query_button {padding: 5px 20px;}
  	}
    </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/logo.png"  style="width: 127px;margin: 0px;height:50px;"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-right">
        <?php
        if(!isset($_SESSION['user']))
          {
            echo'
            <li>
                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Connexion</button>
                  <div id="login" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Formulaire de connexion</h4>
                            </div>
                            <div class="modal-body">
                                          <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                              <div class="form-group">
                                                  <label class="sr-only" for="username">Nom Utilisateur</label>
                                                  <input type="text" name="login_username" class="form-control" placeholder="Nom d"utilisateur" required>
                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="password">Mot de passe</label>
                                                  <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" name="submit" value="login" class="btn btn-block">
                                                  Connexion
                                                  </button>
                                              </div>
                                          </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                  </div>
            </li>
            <li>
              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Inscrire</button>
                <div id="register" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title text-center">Formulaire d inscription des membres</h4>
                          </div>
                          <div class="modal-body">
                                        <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="username">Nom d utilisateur</label>
                                                <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Mot de passe</label>
                                                <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="register" class="btn btn-block">
                                                S inscrire                                                </button>
                                            </div>
                                        </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                          </div>
                      </div>
                  </div>
                </div>
            </li>';
          } 
        else
          {   echo' <li> <a href="#" class="btn btn-lg"> Bonjour ' .$_SESSION['user']. '.</a></li>
                    <li> <a href="cart.php" class="btn btn-lg"> Carte </a> </li>; 
                    <li> <a href="destroy.php" class="btn btn-lg"> Se déconnecter </a> </li>';
               
          }
?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <div id="top" >
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
          <div>
              <form role="search" method="POST" action="Result.php">
                  <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Rechercher un livre, un auteur ou une catégorie">
              </form>
          </div>
      </div>

      <div class="container-fluid" id="header">
          <div class="row">
              <div class="col-md-3 col-lg-3" id="category">
                  <div style="background:#d64343;color:#fff;font-weight:800;border:none;padding:15px;"> Accueil </div>
                  <ul>
                      <li> <a href="Product.php?value=entrance%20exam"> Examens </a> </li>
                      <li> <a href="Product.php?value=Literature%20and%20Fiction"> Littérature et fiction </a> </li>
                      <li> <a href="Product.php?value=Academic%20and%20Professional"> Académique et professionnel </a> </li>
                      <!-- <li> <a href="Product.php?value=Biographies%20and%20Auto%20Biographies"> Biographies & Auto Biographies </a> </li> -->
                      <li> <a href="Product.php?value=Children%20and%20Teens"> Enfants et ados </a> </li>
                      <!-- <li> <a href="Product.php?value=Regional%20Books"> Regional Books </a> </li> -->
                      <li> <a href="Product.php?value=Business%20and%20Management"> Affaires et la gestion </a> </li>
                      <li> <a href="Product.php?value=Health%20and%20Cooking"> Santé et cuisine </a> </li>

                  </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                          <li data-target="#myCarousel" data-slide-to="4"></li>
                          <li data-target="#myCarousel" data-slide-to="5"></li>
                      </ol>
                      
                        <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img class="img-responsive" style="height:338px;" src="img/carousel/7.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive " style="height:338px;" src="img/carousel/66.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive"  style="height:338px;" src="img/carousel/11.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" style="height:338px;" src="img/carousel/99.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" style="height:338px;" src="img/carousel/88.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive"  style="height:338px;" src="img/carousel/77.jpg">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 col-lg-3" id="offer">
                  <a href="Product.php?value=Literature%20and%20Fiction">    <img class="img-responsive center-block" style="height:130px;width:290px;" src="img/offers/11.png"></a>
                  <a href="Product.php?value=Health%20and%20Cooking">        <img class="img-responsive center-block"  style="height:130px;width:290px;" src="img/offers/22.png"></a>
                  <a href="Product.php?value=Academic%20and%20Professional"> <img class="img-responsive center-block" style="height:130px;width:290px;" src="img/offers/33.png"></a>
              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid text-center" id="new">
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-1&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" style="height:250px;" src="img/new/1.jpg">
                  <hr>
                  Like A Love Song <br><br>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-2&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div><br>
                  <img class="block-center img-responsive" src="img/new/22.jpg">
                  <hr>
                  Out Of Africa  <br><br>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-33&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div><br>
                  <img class="block-center img-responsive" style="height:250px;" src="img/new/33.png">
                  <hr>
                  Dreams Of Trespass <br><br>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-44&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div><br>
                  <img class="block-center img-responsive" src="img/new/44.jpg">
                  <hr>
                  A Street In Marrakech <br><br>
              </div>
            </a>
          </div>
      </div>
  </div>

  <div class="container-fluid" id="author">
      <h3 style="color:#D67B22;"> AUTEURS POPULAIRES</h3>
      <div class="row">
          <div class="col-sm-5 col-md-3 col-lg-3">
              <a href="Author.php?value=Kevin Lane Keller Philip Kotler" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Philip Kotler<br>
              <img class="img-responsive center-block" style="height:140px;" src="img/popular-author/000.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=E. L. James" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E. L. James<br>
              <img class="img-responsive center-block" style="height:140px;" src="img/popular-author/111.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=J%20K%20Rowling" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J. K. Rowling<br>
              <img class="img-responsive center-block" style="height:140px;" src="img/popular-author/22.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Naguib Mahfouz" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Naguib Mahfouz<br>
              <img class="img-responsive center-block" style="height:140px;width:120px;" src="img/popular-author/33.jpg"></a>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-5 col-md-3 col-lg-3">
              <a href="Author.php?value=Jeffrey%20Archer" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jeffrey Archer<br>
              <img class="img-responsive center-block" style="height:140px;" src="img/popular-author/444.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Salman%20Rushdie" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salman Rushdie<br>
              <img class="img-responsive center-block" style="height:140px;" src="img/popular-author/555.jpg"><a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Timothy A. Philpot" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Timothy A.Philpot<br>
              <img class="img-responsive center-block" style="height:140px;" src="img/popular-author/666.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a href="Author.php?value=Subrata%20Roy" style="text-align:center;color:black;font-weight:500;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subrata Roy<br>
              <img class="img-responsive center-block" style="height:140px;" src="img/popular-author/777.jpg"></a>
          </div>
      </div>
  </div>

  <footer style="margin-left:-6%;margin-right:-6%;">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-1 col-md-1 col-lg-1">
              </div>
              <div class="col-sm-7 col-md-5 col-lg-5">
                  <div class="row text-center">
                      <h2>Entrons en contact !</h2>
                      <hr class="primary">
                      <p>Encore confus? Appelez-nous ou envoyez-nous un e-mail et nous vous répondrons dans les plus brefs délais!</p>
                  </div>
                  <div class="row">
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-earphone"></span>
                          <p>+212644754114</p>
                      </div>
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-envelope"></span>
                          <p>lyceemoulayrachid@gmail.com</p>
                      </div>
                  </div>
              </div>
              <div class="hidden-sm-down col-md-2 col-lg-2">
              </div>
              <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                  <h2 style="color:#D67B12;">Suivez-nous sur</h2>
                  <div>
                      <a href="https://twitter.com/" target="_blank">
                      <img title="Twitter" alt="Twitter" src="img/social/twitter.png" width="30" height="30" />
                      </a>
                      <a href="https://www.facebook.com/" target="_blank">
                      <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="30" height="30" />
                      </a>
                      <a href="https://plus.google.com/" target="_blank">
                      <img title="google+" alt="google+" src="img/social/google.jpg" width="30" height="30" />
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </footer>

<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" id="query_button" class="btn btn-lg" data-toggle="modal" data-target="#query">Demander une requête</button>
  <!-- Modal -->
  <div class="modal fade" id="query" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Posez votre question ici</h4>
          </div>
          <div class="modal-body">           
                    <form method="post" action="query.php" class="form" role="form">
                        <div class="form-group">
                             <label class="sr-only" for="name">Nom</label>
                             <input type="text" class="form-control"  placeholder="votre Nom" name="sender" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="email">Email</label>
                             <input type="email" class="form-control" placeholder="exemple@gmail.com" name="senderEmail" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="query">Message</label>
                             <textarea class="form-control" rows="5" cols="30" name="message" placeholder="Your message" required></textarea>
                        </div>
                        <div class="form-group">
                              <button type="submit" name="submit" value="query" class="btn btn-block">
                                                          Envoyer 
                               </button>
                        </div>
                    </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
          </div>
      </div>
    </div>  
  </div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>	