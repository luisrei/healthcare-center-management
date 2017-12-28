<?php session_start(); ?>
<html>
	<head><title>CheckPatient</title></head>
	<body>
<?php   $host = "db.tecnico.ulisboa.pt";	$user = "ist178486";	$pass = "nhdd2783";
		$dsn = "mysql:host=$host;dbname=$user";
		try{ $connection = new PDO($dsn, $user, $pass);	}
		catch(PDOException $exception)	{ echo("<p>Error: "); echo($exception->getMessage()); echo("</p>"); exit();	}
		try{
		$patient_name = $_REQUEST['patient_name'];
		$stmt = $connection->prepare("SELECT name FROM patient WHERE name like '%$patient_name%' ORDER BY name");
		$stmt->bindParam(':patient_name', $patient_name);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_COLUMN,0);	
		if ( $data[0] <> FALSE ){
?>			 <p>O paciente existe na base de dados. </br> Selecione-o e marque uma consulta. </p>
			<table width="400">
<?php		foreach($data as $row){
?>				<tr><td> <?php echo($row); ?> </td><td>
				<form action="Task2.php" method="post"><input type="hidden" name="patient_name" value="<?php echo($row) ?>"/>
				<input type="submit"  value="Avancar para Task2"/></form></td><tr>
<?php		}
			echo("</table>");
		}else{
			$_SESSION['patient_name'] = $_REQUEST['patient_name'];
?>			<form action="Task3.php" method="post">
				<p>O paciente nao existe na base de dados. </br> Registe-o e marque uma consulta. </p>
				<p><input type="submit" value="Avancar para Task3"/></p>
			</form>	
<?php	}	
		$stmt = null;	$connection = null;	}
		catch(PDOException $exception)	{ echo("<p>Error: "); echo($exception->getMessage()); echo("</p>"); exit();	}
?>		</fieldset>
	</body>
</html>
