<?php session_start(); ?>
<html>
	<head><title>SubmitTask3</title></head>
	<body>
<?php	$host = "db.tecnico.ulisboa.pt"; $user = "ist178486"; $pass = "nhdd2783"; $dsn = "mysql:host=$host;dbname=$user";
		try{	$connection = new PDO($dsn, $user, $pass);	}
		catch(PDOException $exception)	{ echo("<p>Error: "); echo($exception->getMessage()); echo("</p>"); exit();	}
		try{
		$connection->beginTransaction();
		$patient_id = $_REQUEST['patient_id']; $patient_name = $_SESSION['patient_name']; $birthday = $_REQUEST['birthday'];
		$address = $_REQUEST['address'];
		$stmt = $connection->prepare("INSERT INTO patient VALUES (:patient_id, :patient_name, :birthday, :address)");
		$stmt->bindParam(':patient_id', $patient_id);		$stmt->bindParam(':patient_name', $patient_name);
		$stmt->bindParam(':birthday', $birthday);			$stmt->bindParam(':address', $address);
		$stmt->execute();
		$doctor_name = $_REQUEST['doctor_name'];
		$stmt = $connection->prepare("SELECT doctor_id FROM doctor WHERE name = :doctor_name");
		$stmt->bindParam(':doctor_name', $doctor_name);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_COLUMN,0);	$doctor_id = $data[0];
		$app_date = $_REQUEST['app_date'];
		if( date('w', strtotime($app_date)) % 6 == 0 ) {
			echo("Nao ha consultas ao fim-de-semana."); 
?> 			<p><form action="Task3.php" method="post"><input type="submit" value="Reinserir dados"/></form>
			<form action="Task1.php" method="post"><input type="submit" value="Regressar a Task1"/></form></p>
<?php 		exit(); }
		$now = time();
		$today = date("Y-n-d", $now);
		if( strtotime($app_date) < strtotime($today) ){
			echo("Ainda nao inventaram maquinas do tempo. Nao se pode marcar consultas no passado."); 
?> 			<p><form action="Task3.php" method="post"><input type="submit" value="Reinserir dados"/></form>
			<form action="Task1.php" method="post"><input type="submit" value="Regressar a Task1"/></form></p>
<?php 		exit(); }
		$office = $_REQUEST['office'];
		$stmt = $connection->prepare("INSERT INTO appointment VALUES (:patient_id, :doctor_id, :app_date, :office)");
		$stmt->bindParam(':patient_id', $patient_id);		$stmt->bindParam(':doctor_id', $doctor_id);
		$stmt->bindParam(':app_date', $app_date);			$stmt->bindParam(':office', $office);
		$stmt->execute();		$connection->commit();	$connection = null;
		echo ("<p>New records created successfully</p>");	}
		catch(PDOException $exception)	{ echo("<p>Error: "); echo($exception->getMessage()); echo("</p>"); 
		$stmt = null;	$connection->rollback(); $connection = null;	exit();	}
?>		</br><form action="Task1.php" method="post"><input type="submit" value="Regressar a Task1"/></form>
	</body>
</html>