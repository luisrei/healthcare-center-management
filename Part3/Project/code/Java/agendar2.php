<?php
include "connect.php";
?>

<?php


$sqldoctor = "SELECT * FROM doctor;";

$doctor = $connection->query($sqldoctor);


if(isset($_POST['submit']))
{
	
$patient_id = $_POST['patient_id'];
$name = $_POST['name'];
$birthday = $_POST['birthday'];
$address = $_POST['address'];
$doctor_id = $_POST['doctor_id'];
$app_date = $_POST['app_date'];
$office = $_POST['office'];
$fds= $_POST['fdsvar']; 


$sql2="INSERT INTO patient".
		"(patient_id,name,birthday,address)".
		"VALUES ('$patient_id','$name','$birthday','$address')";

$sql="INSERT INTO appointment".
	"(patient_id, doctor_id, app_date, office)".
	"VALUES ('$patient_id', '$doctor_id', '$app_date', '$office' )";   


	
	if($fds == 1) {
				print("Por favor verifique a Data da Consula.<br>Nao e possivel a marcacao de consultas durante o fim-de-semana.<br>Nem em datas anteriores ao dia de hoje.<br> <br>Nao foi inserido o paciente na base de dados!<br><br>");
	
	} else { 
	
					$q2 = $connection->prepare($sql2);
					$q = $connection->prepare($sql);
					$q2 -> execute();
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
	<body >
		
		<form name="myform" method="post" action="<?php $_PHP_SELF ?>">
				<label> <font size="5" face="calibri" color="black"> Dados do Novo Cliente </font>
					<br>
					<br>
					<font size="4" face="calibri" color="black">ID Paciente</font></a> <br>
					<input id="inputtxt" type="text" name="patient_id" />
				</label>
				<br>				
				<label>
					<font size="4" face="calibri" color="black">Nome</font></a>  <br>
					<input id="inputtxt" type="text" name="name" />
				</label>
				<br>
				<label>
					<font size="4" face="calibri" color="black">Data de Nascimento (AAAA-MM-DD)</font></a>  <br>
					<input id="inputtxt" type="text" name="birthday" />
				</label>
				<br>
				<label>
					<font size="4" face="calibri" color="black">Morada</font></a> <br>
					<input id="inputtxt" type="text" name="address" />
				</label>
				<br>	
				<br>	
				<br>		
				<label> <font size="5" face="calibri" color="black"> Dados da Consulta </font>
					<br>
					<br>
					<font size="4" face="calibri" color="black">Medico </font></a>  <br>
					<select  id="myselect"  name="doctor_id">
						<?php  	foreach($doctor as $row)
  						{ ?>
									<option value=<?php echo($row["doctor_id"]) ?> > <?php echo($row["name"]) ?> </option>			
						<?php } ?> 
					</select>
				</label>
				<br>
				<label> 
					<font size="4" face="calibri" color="black">Data (AAAA-MM-DD)</font></a>  <br>
					<input id="app_date" type="text" name="app_date" />
				</label>
				<br>
				<label>
					<font size="4" face="calibri" color="black">Sala</font></a> <br>
					<input id="inputtxt" type="text" name="office" />
				</label>
				<br>
				<br>
				<input type="hidden" name="fdsvar" value="">
				<br>
				<label>
					<input id="submit" name="submit" onclick="fds()"  type="submit" value="Agendar" />
				</label>				
		</form>
							<input id="submit" type="button" name ="voltar" value="Voltar"  onclick="window.location.href='init.php'">
			

	<script>
			function fds() {
    			var text;
    			var d = new Date(document.getElementById("app_date").value);
   				var today = new Date();
    			if (d.getDay() == 6 || d.getDay() == 0 || d.getTime() < today.getTime()  ) {
        			text = 1;
    			} else {
        			text = 0;
    			}
    			document.myform.fdsvar.value = text;
    		
			}
	</script>
	
	</body>
</html>