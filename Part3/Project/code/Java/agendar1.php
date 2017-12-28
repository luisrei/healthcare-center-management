<?php
include "connect.php";
?>

<?php


$sqldoctor = "SELECT * FROM doctor;";

$doctor = $connection->query($sqldoctor);


if(isset($_POST['submit']))
{

$patient_id = strval($_GET['x']);
$doctor_id = $_POST['doctor_id'];
$app_date = $_POST['app_date'];
$office = $_POST['office'];
$fds= $_POST['fdsvar'];  


$sql="INSERT INTO appointment".
	"(patient_id, doctor_id, app_date, office)".
	"VALUES ('$patient_id', '$doctor_id', '$app_date', '$office' )";   


	
	if($fds == 1) {
				print("Por favor verifique a Data da Consula.<br>Nao e possivel a marcacao de consultas durante o fim-de-semana.<br>Nem em datas anteriores ao dia de hoje.<br> <br><br>");


	} else { 
         		$q = $connection->prepare($sql);
				$q -> execute();  	 
    			header ("Location: init.php");   
    			
	 }

 }
?>

<html>

	<head>
			<title>Agendamento</title>
			<link rel="stylesheet" type="text/css" href="estilo2.css">
			<link rel="stylesheet" type="text/css" href="estilo3.css">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8859-1" />
	</head>
	
	<body>

		

		<form name="myform" method="post" action="<?php $_PHP_SELF ?>">
				
			<label> <font size="5" face="calibri" color="black"> Dados da Consulta </font>
				<br>
				<br>
				<font size="4" face="calibri" color="black">Medico</font></a> <br>
				
				<select id="myselect" name="doctor_id">
						<?php  	foreach($doctor as $row)
  						{ ?>
						<option value=<?php echo($row["doctor_id"]) ?> > <?php echo($row["name"]) ?> </option>			
						<?php } ?> 
				</select>
			</label>
			<br>
			<label>
					<font size="4" face="calibri" color="black">Data (AAAA-MM-DD)</font></a> 
					<br>
					<input id="app_date" type="text" name="app_date" />
			</label>
			<br>
			<label>
					<font size="4" face="calibri" color="black">Sala</font></a>
					<br>
					<input id="inputtxt" type="text" name="office" />
			</label>
			<br>
			<br><br><br>
			<br>
			<input type="hidden" name="fdsvar" value="">
			<label>
				<input id="submit" name="submit" onclick="fds()" type="submit" value="Agendar" /><br><br>
			</label>
		<input id="submit" type="button" value="Voltar"  onclick="window.location.href='init.php'">

</form>

	<script>
			function fds() {
    			var text;
    			var d = new Date(document.getElementById("app_date").value);
   				var today = new Date();
    			if (d.getDay() == 6 || d.getDay() == 0 || d.getTime() < today.getTime() ) {
        			text = 1;
    			} else {
        			text = 0;
    			}
    			document.myform.fdsvar.value = text;
    		
			}
	</script>


</body>
</html>