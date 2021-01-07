
<?php
//session_start();
//session_destroy();
//header("Location: connexion.php");

$host="127.0.0.1";
$user="root";
$password="";
$database="app_inscription";

Function connect_bd(){
	
	try{
		$connexion=new PDO('mysql:dbname=app_inscription;host=localhost','root','');
		
	}
	catch(PDOException $e){
		$connexion=null;
$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
echo $msg;
exit() ;
	 }
return $connexion;
}
?>