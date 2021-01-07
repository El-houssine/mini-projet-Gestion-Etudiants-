<?php

/*if(!isset($_SESSION['acces'])||empty($_SESSION['acces']))
{
  header("Location:connexion.php");
}*/
?>


<!--menu -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inscription.php">Application WEB</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="inscription.php">Inscription</a></li>
			<li><a href="gestion.php">Gestion Inscriptions</a></li>
            <li style="padding-left:200px;"><a href="">Bonjour <?php 
            if(isset($_SESSION['nom']))
           echo $_SESSION['nom'];
  
            ?></a></li>
			<li><a href="deconnexion.php">Déconnexion</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<!--/menu -->