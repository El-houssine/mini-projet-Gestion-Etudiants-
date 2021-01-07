<?php
session_start();
	
	include('header/header.php');
	include('menu.php');
	include('bdconnexion.php');
				$pdo=connect_bd();
	if(!isset($_SESSION['acces'])||empty($_SESSION['acces']))
{
	header("Location:connexion.php");
}
	

?>
	
	<!--container -->
    <div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title">Formulaire de modification des inscriptions</h3></div>
		</div>
		<div class="panel-body">
		<?php 
		$CIN="";
		$etudiant="";
		$module="";
		$semestre="";
		$Niveau="";
		if(isset($_GET["num"]))
			{
				
				$num=$_GET["num"];

				if (!empty($num)){
					$requete='SELECT * from inscription insc join etudiant et on insc.id_etu =et.id_etu join semestre s on insc.id_sem=s.id_sem join module m on insc.id_mod=m.id_mod where num=:num';
				  $resulte=$pdo->prepare($requete);
				  $resulte->bindValue(':num',$num,PDO::PARAM_INT);
				  $resulte->execute();
				  $data=$resulte->fetchAll();
				
				 $Niveau=$data[0]['niveau'];
				$CIN=$data[0]['id_etu'];
				$etudiant=$data[0]['nom complet'];
				$module=$data[0]['id_mod'];
				$semestre=$data[0]['id_sem'];

				}
			}else {
               header("Location:gestion.php");
		     }
		  
		  ?>
			<form action= "#" method="POST" class="form-inline">
				<label for="cin" class="control-label"><span></span> CIN :</label> 
				<input type="text" name="cin" class="form-control input-l" style="margin-left:7%" disabled value="<?php echo $CIN ?>" /><br><br>
				<label for="nom" class="control-label"><span></span> Nom complet :</label> 
				<input type="text" name="nom" style="margin-left:1%" class="form-control input-l" disabled value="<?php echo $etudiant ?>" /><br><br>

				<legend><span>*</span>Niveau</legend>
					<label for="niveau" class="control-label">Débutant</label> 
					<input class="form-control input-l" type="radio" name="niveau" value="0" <?php if(isset($_POST["niveau"]) && $_POST["niveau"]=="Débutant" ) echo "checked=\"checked\"" ?> required/> 
					<label for="niveau" class="control-label" style="margin-left:30%">Initié </label> 
					<input class="form-control input-l" type="radio" name="niveau" value="1" <?php if(isset($_POST["niveau"]) && $_POST["niveau"]=="Initié" || empty($_POST["niveau"])) echo "checked=\"checked\"" ?>/>
				</fieldset>
				<br><br>
				<label for="module" class="control-label"><span>*</span> Module:</label> 
				 <select name="module" style="margin-left:4%" class="form-control input-l" required>
					<?php 
					
						
							$result=$pdo->query("SELECT * from module ");

						
						 while($donne=$result->fetch(PDO::FETCH_ASSOC))
						 {
						 	echo'<option value="'.$donne['id_mod'].'">';
						 	if ($donne['id_mod']==$module) {
						 		echo '"selected='.$donne['lib_mod'].'">"'.$donne['lib_mod']."</option>";
						 		
						 	}
						 }

					?>
					<option></option>
				</select><br><br />      
				<label for="semestre" class="control-label"><span>*</span> Semestre : </label> 
				<select name="semestre" style="margin-left:2.5%" class="form-control input-l" required>
					<?php 
					
						$result=$pdo->query("SELECT * from semestre ");
						 while($donne=$result->fetch(PDO::FETCH_ASSOC))
						 {
						 	echo'<option value="'.$donne['id_sem'].'" selected=\"selected\">'.$donne['lib_sem'].'</option>';
						 }
					?>
					<option></option>
				</select><br><br />
		
				
				<input type="submit" value="Modifier" name="Modifier" class="btn btn-success active" />
				<input type="reset" class="btn btn-danger" value="Effacer" />  
			</form>
		    <?php 
		    	
			?>
		</div>
		<!-- /.container -->
		<div class="panel-footer">
			
			<?php	
			if(isset($_POST['Modifier']))
			{
				if(isset($_GET["num"]))
				{
				if(!empty($_GET["num"])&& isset($_POST['niveau'])&&isset($_POST['module'])&&isset($_POST['semestre']))
				{

				    //$pdo=connect_bd();
				     $num=$_GET["num"]; 
				     $niveau=$_POST['niveau'];
					$id_sem=$_POST['semestre'];
					$id_mod=$_POST['module'];
					
                   $nbrLign=$pdo->prepare('UPDATE  inscription SET niveau=:niveau,id_sem=:id_sem,id_mod=:id_mod, date=NOW() where num=:num');
                   $nbrLign->bindValue(':niveau',$niveau,PDO::PARAM_BOOL);
                  $nbrLign->bindValue(':id_sem',$id_sem,PDO::PARAM_INT);
                   $nbrLign->bindValue(':id_mod',$id_mod,PDO::PARAM_INT);
                    $nbrLign->bindValue(':num',$num,PDO::PARAM_INT);
                   $nbrLign->execute();

                   

               }
               
           }
		
	     }
				


					include('footer/footer.php');
				
			?>
		</div>
		

	</div>
		
	
	
 </body>
</html>
