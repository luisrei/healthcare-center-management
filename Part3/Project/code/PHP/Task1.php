<?php session_destroy(); ?>
<html>
	<head><title>Task1</title></head>
	<body>
		<form action="checkpatient.php" method="post">
			<fieldset><legend>Procura na base de dados do centro de saude</legend>
				<p>Nome do paciente: <input type="text" name="patient_name"/>	
				<input type="submit" value="Verificar"/></p>
			</fieldset>
		</form>
	</body>
</html>

