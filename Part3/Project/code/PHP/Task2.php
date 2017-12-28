<?php session_start(); ?>
<html>
	<head><title>Task2</title></head>
	<body>
		<form action="MarcacaoTask2.php" method="post">
			<fieldset><legend>Marcacao de uma consulta</legend>
				<table>
					<tr><td>Medico:</td><td>
					<select name="doctor_name">
			<?php   $host = "db.ist.utl.pt";	$user = "ist178486";	$pass = "nhdd2783";
					$dsn = "mysql:host=$host;dbname=$user";
					try{$connection = new PDO($dsn, $user, $pass);	}
					catch(PDOException $exception){ echo("<p>Error: "); echo($exception->getMessage()); echo("</p>"); exit();}
					$_SESSION['patient_name'] = $_REQUEST['patient_name'];
					try{
					$sql = "SELECT name FROM doctor ORDER BY name";
					$result = $connection->query($sql);
					foreach($result as $row){
						$doctor_name = $row['name']; echo("<option value=\"$doctor_name\">$doctor_name</option>");	}
					$connection = null;
					}
					catch(PDOException $exception){	echo("<p>Error: ");	echo($exception->getMessage());	echo("</p>"); exit();}
			?>		</select></td></tr>
					<tr><td>Data (YYYY-MM-DD):</td><td><input type="text" name="app_date"/></td></tr>
					<tr><td>Sala:</td><td><input type="text" name="office"/></td></tr>
				</table>
				<p><input type="submit" value="Confirmar"/></p>
			</fieldset>
		</form>
	</body>
</html>