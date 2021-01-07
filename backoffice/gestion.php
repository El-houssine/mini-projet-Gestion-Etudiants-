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


 <div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title">Inscriptions en ligne</h3></div>
		</div>
		<div class="panel-body">
		
		  <!-- début datatable-->
		    <table id="example">
			  <thead>
				<tr><th>Niveau</th><th>CIN</th><th>Etudiant</th><th>Module</th><th>Semestre</th><th>Date</th><th>Gestion</th></tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	if(isset($_GET["num"]))
			{
				
				$num=$_GET["num"];

				if (!empty($num)){
				  $requete='DELETE FROM inscription where num=:num';
				  $resulte=$pdo->prepare($requete);
				  $resulte->bindValue(':num',$num,PDO::PARAM_INT);
				  $resulte->execute();
				 // header("location:gestion.php");
				  echo "supprimé avec succés";
				  echo $num;
				}
			}


			$requete='SELECT * from inscription insc join etudiant et on insc.id_etu =et.id_etu join semestre s on insc.id_sem=s.id_sem join module m on insc.id_mod=m.id_mod';
			$result=$pdo->prepare($requete);
			$result->execute();
			$data=$result->fetchAll();
			for($i=0;$i<count($data);$i++) { 
				$num=$data[$i]['num'];
				if($data[$i]['niveau']==0)
				{$Niveau='dibutant';}
				else $Niveau='initie';
				$CIN=$data[$i]['id_etu'];
				$etudiant=$data[$i]['nom complet'];
				$module=$data[$i]['lib_mod'];
				$semestre=$data[$i]['lib_sem'];
				$date=$data[$i]['date'];

				echo "<tr><th>".$Niveau."</th><th>".$CIN."</th><th>".$etudiant."</th><th>".$module."</th><th>".$semestre."</th><th>".$date."</th><th><a href='gestion.php?num=$num' onclick='return confirm(\"etes vous sur du supprimé!!\");'><image src='../assets/images/delete.png' style='height: 13px;'></a><a href='modif.php?num=$num'> <image src='../assets/images/update.jpg' style='height: 13px;'></a></th></tr>";
			
			}  
			
			
			  ?>
			  </tbody>
			</table> 
			 <!-- fin datatable-->
			  <script type="text/javascript" charset="utf8" src="../assets/jquery/jquery-1.8.2.min.js"></script>
			  <script type="text/javascript" charset="utf8" src="../assets/jquery/jquery.dataTables.min.js"></script>
			  <script>
			  //script datatable
			  $(function(){
				$("#example").dataTable();
			  });
			  $("#example").dataTable({
		
			  	   "oLanguage": {
					  "sLengthMenu": "Afficher _MENU_ inscriptions",
					  "sSearch": "Rechercher:",
					  "sInfo":"Total de _TOTAL_ inscriptions (_END_ / _TOTAL_)",
					  "oPaginate": {
						"sNext": "Suivant",
						"sPrevious":"Precedent"
					  }
					  
					}
			    });
			  </script>
		
		</div>
		<!-- /.container -->
		<div class="panel-footer">
			<?php
		     include('footer/footer.php');
		
	       ?>
		</div>
	</div>
		
	
	

 </body>
</html>


  

 

