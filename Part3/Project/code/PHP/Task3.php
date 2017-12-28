<?php session_start(); ?>
<html>
	<head><title>Task3</title></head>
	<body>
		<form action="MarcacaoTask3.php" method="post">
			<fieldset><legend>Dados do paciente</legend>
				<table><tr><td>ID:</td><td><input type="text" name="patient_id"/></td></tr>
					<tr><td>Dia de nascimento (YYYY-MM-DD):</td><td><input type="text" name="birthday"/></td></tr>
					<tr><td>Morada:</td><td><input type="text" name="address"/></td></tr>
				</table>
			</fieldset></br>
			<fieldset><legend>Marcacao de uma consulta</legend>
				<table>
					<tr><td>Medico:</td><td>
					<select name="doctor_name">
			<?php	$host = "db.ist.utl.pt";	$user = "ist178486";	$pass = "nhdd2783";
					$dsn = "mysql:host=$host;dbname=$user";
					try{$connection = new PDO($dsn, $user, $pass);	}
					catch(PDOException $exception){	echo("<p>Error: ");	echo($exception->getMessage());	echo("</p>"); exit();}
					try{
					$sql = "SELECT name FROM doctor ORDER BY name";
					$result = $connection->query($sql);
					foreach($result as $row){	$doctor_name = $row['name']; echo("<option value=\"$doctor_name\">$doctor_name</option>");	}
					$connection = null;
					}
					catch(PDOException $exception){	echo("<p>Error: ");	echo($exception->getMessage());	echo("</p>"); exit();	}
			?>		</select></td></tr>
					<tr><td>Data (YYYY-MM-DD):</td><td><input type="text" name="app_date"/></td></tr>
					<tr><td>Sala:</td><td><input type="text" name="office"/></td></tr>
				</table>
				<p><input type="submit" value="Confirmar"/></p>
			</fieldset>
		</form>
	</body>
</html>