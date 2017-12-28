<?php
	include ("connect.php");
	$sql = "SELECT * FROM patient;";
	$result = $connection->query($sql);
?>

<html>
	<head>
		<script src="procura.js"></script>
		<link rel="stylesheet" type="text/css" href="estilotabela.css">
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<title>Agendamento</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8859-1" />
	</head>
	
	<body>

		<input type="text" id="myInput" onkeyup="procura()" placeholder="Procurar pelo Nome..">
		<table id="myTable">
 			 <tr class="header">
    		<th>Nome</th>
    		<th>Data de Nascimento</th>
    		<th>Morada</th>
    		<th></th>
  			</tr>
			<?php  	foreach($result as $row)
  			{ ?>
				  <tr>
   				 	  <td> <?php echo($row["name"]) ?> </td>
    			 	  <td> <?php echo($row["birthday"]) ?> </td>
    			   	  <td> <?php echo($row["address"]) ?> </td>
   				 	  <td><a href="agendar1.php?x=<?php echo $row ['patient_id'];?>"><button  class="button" type="button">Agendar consulta</button></a></td>
   				   </tr> 
  			  <?php } ?> 
  		 </table>

		<input class="button1" type="button" value="Inserir Cliente Novo e Agendar Consulta" 
		onclick="window.location.href='agendar2.php'">


	</body>
</html>
