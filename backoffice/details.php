<?php
/*if(isset($_GET["num"]))
			{
				include('connexion.php');
				$pdo=connect_bd();
				$num=$_GET["num"];

				if (!empty($num)){
				  $requete='DELETE FROM inscription where num=:num';
				  $resulte=$pdo->prepare($requete);
				  $resulte->bindValue(':num',$num,PDO::PARAM_INT);
				  $resulte->execute();
				  header("location:gestion.php");
				  echo "supprimé avec succés";
				  echo $num;
				}
			}*/
?>