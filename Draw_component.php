<?php
require_once "aux_functions.php";

function draw_component($employee_rank,$data) {

$punches_count = count($data["data"][0]["employees"][$employee_rank]["punches"]); //based on the $punches_count i ll draw my table
$real_punches_count = $punches_count + 1; // real punches count to determine how much rows to merge based on bunches available
$cumul_cellule_color = "" ;//a cellule color based on employee cumule//a cellule color based on employee state : error/absent/...
$employee_state = "" ; // variable based on the employee punche state
$yesterday = date('D d-m-Y',strtotime($data["data"][0]["date"])); // this variable holds the day's date
$base_800 = new DateTime('08:30:00');
$Late = "";

echo '<table class="responsive-table" id="datatable">
	<thead>
  <tr>
    <th>'.$data["data"][0]["employees"][$employee_rank]["first_name"]." ".$data["data"][0]["employees"][$employee_rank]["last_name"].'</th>
    <th>'.$data["data"][0]["employees"][$employee_rank]["site_name"].'</th>
    <th>'.$data["data"][0]["employees"][$employee_rank]["department_name"].'</th>
    <th colspan="3">'.$yesterday.'</th>  
  </tr>
  	</thead>
  	<tbody>
  <tr>
    <td colspan="3" rowspan="'.$real_punches_count.'">State </td>
    <td rowspan="'.$real_punches_count.'" >Pointage</td>
    <td>heure</td>
    <td>Ecart</td>
   
     </tr>';

   //--------punches
    $i = 0;
    for ($i=0;$i<$punches_count;$i++){ // this loop prinf punches
    if ( $i==0) {
    $in_time  = new DateTime(explode(" ", $data["data"][0]["employees"][$employee_rank]["punches"][$i]["date"])[1])   ;
    if ($in_time>$base_800) {

    	   echo'  <tr>
          <td bgcolor="#f39c12" >'.explode(" ", $data["data"][0]["employees"][$employee_rank]["punches"][$i]["date"])[1].'</td>
          <td></td>
               </tr>';
            $Late = " (Late) ";

                            }//if($in_time>$base_800)
    else                    {
    	 echo'  <tr>
       <td>'.explode(" ", $data["data"][0]["employees"][$employee_rank]["punches"][$i]["date"])[1].'</td>
       <td></td>
               </tr>';

                            }//else

               }//if( $i==0)
    else {
    echo'  <tr>
    <td>'.explode(" ", $data["data"][0]["employees"][$employee_rank]["punches"][$i]["date"])[1].'</td>
    <td></td>
          </tr>';
         }
                                     }//end of for loop
   //--------end punches
  $cumul = $data["data"][0]["employees"][$employee_rank]["total_worked_duration_in_milliseconds"] ;
  $Ecart = $data["data"][0]["employees"][$employee_rank]["total_worked_duration_in_milliseconds"] - $data["data"][0]["employees"][$employee_rank]["total_required_work_duration_in_milliseconds"]; //calcule d'ecart
  

  

  if ($Ecart<0) $cumul_cellule_color = "#ff7f82";
  else  $cumul_cellule_color = "#7fff99"  ;   


  if ($punches_count == 0 && $Ecart==0 )$employee_state = "Leave";
 
  else  {
             if ($punches_count == 0)$employee_state = "Absent";

             else {

             if ( $punches_count % 2 != 0) $employee_state = ("Error" . $Late);
             else    {
                      if ($Ecart<0) {
                       $cumul_cellule_color = "#e74c3c";
                       $employee_state = ("Insufficient" . $Late);
                                    }
                     else {
                        $cumul_cellule_color = "#2ecc71"  ;  
                        $employee_state = ("Normal" . $Late);
                          }//else



                    }//else
                  
                  }//else

        }//else


    echo ' <tr>
    <td colspan="3">'.$employee_state.'</td>
    <td>Cumul du jour</td>
    <td bgcolor='.$cumul_cellule_color.'><b>'.msToTime($cumul).'</b></td>
    <td bgcolor='.$cumul_cellule_color.'>'.msToTime($Ecart).'</td>
           </tr>
           </tbody>
        </table>';

                                         }// end of function draw_component
?>