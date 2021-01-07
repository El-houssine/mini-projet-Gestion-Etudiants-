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
			<div class="panel-heading"><h3 class="panel-title">Formulaire d'Ajout des inscriptions</h3></div>
		</div>
		<div class="panel-body">
		  
			<form action="#" method="POST" class="form-inline">

				<label for="cin" class="control-label"><span>*</span> CIN:</label> 
				<select name="cin" class="form-control input-l" required >
				    
					
					<?php 
					$result=$pdo->query("SELECT * from etudiant ");

						
						 while($donne=$result->fetch(PDO::FETCH_ASSOC))
						 {
						 	echo'<option value="'.$donne['id_etu'].'">'.$donne['id_etu'].'</option>';
						 }

			 
			  	
			  		
					?>
					<option></option>
					
				</select> 
				<fieldset>
					<legend><span>*</span>Niveau</legend>
					<label for="niveau" class="control-label">Débutant</label> 
					<input class="form-control input-l" type="radio" name="niveau" value="0" <?php if(isset($_POST["niveau"]) && $_POST["niveau"]=="Débutant" ) echo "checked=\"checked\"" ?> required/> 
					<label for="niveau" class="control-label" style="margin-left:30%">Initié </label> 
					<input class="form-control input-l" type="radio" name="niveau" value="1" <?php if(isset($_POST["niveau"]) && $_POST["niveau"]=="Initié" || empty($_POST["niveau"])) echo "checked=\"checked\"" ?>/>
				</fieldset>
				
				<label for="module" class="control-label"><span>*</span> Module:</label> 
				<select name="module"  class="form-control input-l" required>
					
					

					<?php 
					
							$result=$pdo->query("SELECT * from module ");

						
						 while($donne=$result->fetch(PDO::FETCH_ASSOC))
						 {
						 	echo'<option value="'.$donne['id_mod'].'" selected=\"selected\">'.$donne['lib_mod'].'</option>';
						 }

					?>
					<option></option>
	
				</select><br><br>
								
				<label for="semestre" class="control-label"><span>*</span> Semestre : </label> 
				<select name="semestre"  class="form-control input-l" required>
					

					<?php 
					
						$result=$pdo->query("SELECT * from semestre ");
						 while($donne=$result->fetch(PDO::FETCH_ASSOC))
						 {
						 	echo'<option value="'.$donne['id_sem'].'" selected=\"selected\">'.$donne['lib_sem'].'</option>';
						 }
					?>
					<option></option>
				</select><br><br />
		
							
				<input type="submit" value="Ajouter" name="INSERT" class="btn btn-success active" />
				<input type="reset" class="btn btn-warning" value="Effacer" />
			</form>
		</div>
		<!-- /.container -->
		<div class="panel-footer">
			<?php
			if(isset($_POST['INSERT']))
			{



			if(empty($_POST['cin'])||empty($_POST['niveau'])||empty($_POST['module'])||empty($_POST['semestre']))
				{
					echo "<span>*</span>  Veuillez saisir tous les champs ! ";
				}
				else
				{
					$niveau=$_POST['niveau'];
					$id_etu=$_POST['cin'];
					$id_sem=$_POST['semestre'];
					$id_mod=$_POST['module'];
					
                   $nbrLign=$pdo->prepare('INSERT INTO inscription (num, niveau,id_etu,id_sem,id_mod, date) VALUES (NULL,:niveau,:id_etu,:id_sem,:id_mod,NOW())');
                   $nbrLign->bindValue(':niveau',$niveau,PDO::PARAM_BOOL);
                   $nbrLign->bindValue('id_etu',$id_etu,PDO::PARAM_STR);
                   $nbrLign->bindValue(':id_sem',$id_sem,PDO::PARAM_INT);
                   $nbrLign->bindValue(':id_mod',$id_mod,PDO::PARAM_INT);
                   $nbrLign->execute();
                   echo "Bien ajouté";
               }
				
				} 
			?>
			<?php			
					include('footer/footer.php');
				
			?>
		</div>
		

	</div>
		
	
	
 </body>
</html>
