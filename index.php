<html>
<head>
<link rel="stylesheet" type="text/css" href="custom.css">
<script type="text/javascript" src="filter.js"></script>
</head>

<body>

<div class="container">
REPORT TYPE:
<div class="custom-select" style="width:200px;">
  <select class="light-table-filter" data-table="order-table" >
    <option value="">Rapport entier</option>
    <option value="Normal">Normal</option>
    <option value="Leave">Leaves</option>
    <option value="Error">Error</option>
    <option value="Late">Late</option>
    <option value="Absent">Absent</option>
    <option value="Insufficient">Insufficient</option>
   
  </select>
</div>




<input type="search" class="light-table-filter" data-table="order-table" placeholder="Chercher par nom...">
<table class="order-table table">
		
	      <thead>
			<tr>
				<th>Rapport journalier de présence</th>	
			</tr>
		 </thead>

		 <tbody>

<?php
require_once "Jsondata.php";
require_once "Draw_component.php";

$Data = seek_data(date("Y-m-d", strtotime( '-1 days' ) ),date("Y-m-d", strtotime( '-1 days' ) ));

$employeescount = count($Data["data"][0]["employees"]); //le nombre totale des employees

for ($i=0;$i<$employeescount;$i++){
	echo '<tr> <td class="outside">';
    draw_component($i,$Data);
    echo '</td> </tr>';
                                                          }//for

?>

</tbody>
</thead>
</table>
</div>
</body>
</html>