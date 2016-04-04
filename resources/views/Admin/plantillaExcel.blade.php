<?php
session_start();
header('Content-type: application/vnd.ms-excel; charset=UTF-8');
header("Content-Disposition: attachment; filename=reporteContactosAgenda.xls");
header("Pragma: no-cache");
header("Expires: 0");
set_time_limit(0); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
       <td align='center' colspan="6" style="background-color:#286BCC;color:white;height:50px"><div style="padding-bottom:100px;"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="4">Inscripción de Cursos {{utf8_decode($data[0]->periodoNombre)}}</font></font></strong></div></td>

  </tr>


  <tr>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">Fecha</font></font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">Curso</font></font></strong></div></td>
    <td><div align="center"><strong><font face="Verdana, Arial, Helvetica, sans-serif"><font size="2">Participante</font></font></strong></div></td>
    <td><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Rol</font></strong></div></td>
    <td><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Usiario De Skype</font></strong></div></td>
    <td><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Facilitador</font></strong></div></td>
  </tr>
  <?php foreach ($data as $dato){
    
  echo"<tr>";
    echo"<td align='center'>".$dato->fecha."</td>","<td align='center'>".$dato->nombre."</td>","<td align='center'>".$dato->email."</td>","<td align='center'>"."niguno"."</td>","<td align='center'>".$dato->skype."</td>","<td align='center'>".$dato->nombreFacilitador."</td>";
    
  echo"</tr>";

}?>



</table>