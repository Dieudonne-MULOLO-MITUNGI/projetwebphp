
<!DOCTYPE>
 <html> 
  <head>
   <title>
     <?=pageTitle?>
         </title>

<!-- chargement du css de bootstrap -->
             <link rel="stylesheet" 
           href="dependancies/bootstrap/dist/css/bootstrap.min.css">
         <link rel="stylesheet"
       href="dependancies/bootstrap/dist/css/bootstrap-theme.min.css">

     <meta charset="utf8">
    </head>
   <body class= "container-fluid">

<!--navigation principale -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">projet web</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Accueil<span class="sr-only">(current)</span></a></li>

              <a href="index.php?controller=quiz">Quiz</a>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php
         //récuperation de l 'utilisateur
         $user= getUser();
         $role=$user->getRole();
        //récuperation du nom de l 'utilisateur
        $userName= $user->getUserName();

        ?>
        <li class="navbar-text"> bonjour <?=$userName?> </li>

        <!--affichage du lien connexion/déconnexion-->
        <?php if($user->deconnectable()): ?>
        <li><a href="index.php?
        controller=admin-logout" > déconnexion <a></li>
        <?php else:?>
        <li>
        <a href="index.php?controller=login"> connexion
        admin</a>
        </li>
      <?php endif; ?>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<section class="row">

<!--Affichage des messages flash-->


<?php if(isset($_SESSION["flash"])):?>
<div class="row">
   <div class="col-md-6 col-md-offset-3 alert alert-info">
     <?php
       //affichage du message

        echo $_SESSION["flash"];
        //suppression du message

          unset($_SESSION["flash"]);
        ?>
    </div>
 </div>
<?php endif;?>

  <div class="col-md-8 col-md-offset-2">

    <?=$content?>
  </div>
</section>
    <script src="dependencies/jquerry/dist/jquerry.min.js"></script>
      <script 
          src= "dependencies/bootstrap/dist/js/bootstrap.min.js"></script>
 
      </ul>
    </div>


</body>

</html>