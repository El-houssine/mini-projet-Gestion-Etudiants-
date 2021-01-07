<!--header -->
<?php
include('header/Header.php');
include('backoffice/bdconnexion.php');
session_start();
	if(!isset($_SESSION['acces'])||empty($_SESSION['acces']))
{
	header("Location:backoffice/connexion.php");
}
	$pdo=connect_bd();
?>
	
	<link rel="icon" href="assets/images/icon.ico">							
	
	<!--/header -->
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading"><h3 class="panel-title">Inscriptions en ligne</h3></div>
		</div>
		<div class="panel-body">
		    <table id="example">
			  <thead>
				<tr><th>Niveau</th><th>CIN</th><th>Etudiant </th><th>Module</th><th>Semestre</th><th>Date</th></tr>
			  </thead>
			  <?php
					$requete='SELECT * from inscription insc join etudiant et on insc.id_etu =et.id_etu join semestre s on insc.id_sem=s.id_sem join module m on insc.id_mod=m.id_mod';
			$result=$pdo->prepare($requete);
			$result->execute();
			$data=$result->fetchAll();
			for($i=0;$i<count($data);$i++) { 
				
				if($data[$i]['niveau']==0)
				{$Niveau='dibutant';}
				else $Niveau='initie';
				$CIN=$data[$i]['id_etu'];
				$etudiant=$data[$i]['nom complet'];
				$module=$data[$i]['lib_mod'];
				$semestre=$data[$i]['lib_sem'];
				$date=$data[$i]['date'];

				echo "<tr><th>".$Niveau."</th><th>".$CIN."</th><th>".$etudiant."</th><th>".$module."</th><th>".$semestre."</th><th>".$date."</th></tr>";
			}
			  ?>
			  <tbody>
			  </tbody>
			</table>
			  <script type="text/javascript" charset="utf8" src="assets/jquery/jquery-1.8.2.min.js"></script>
			  <script type="text/javascript" charset="utf8" src="assets/jquery/jquery.dataTables.min.js"></script>
			  <script>
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
			<!--footer -->
				<?php
				require('footer/Footer.php');
				?>
			<!--/footer -->
		</div>
	</div>
		
	
	

 </body>
</html>

