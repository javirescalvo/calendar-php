<?php

require 'vendor/autoload.php';

/* draws a calendar */
function draw_calendar($month){

  # definimos los valores iniciales para nuestro calendario
  $year=date("Y");
  $diaActual=date("j");
  # Obtenemos el dia de la semana del primer dia
  # Devuelve 0 para domingo, 6 para sabado
  $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
  # Obtenemos el ultimo dia del mes
  $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

  /* draw table */
  $calendar = '<div class="col-md-21 calendario border">';
  /* table headings */
  $headings = array('Lun','Mar','Mie','Jue','Vie','Sab','Dom');
  $calendar.= '<div class="row no-gutters border-bottom">
                  <div class="col-md-12 text-center">'.implode('</div>
                  <div class="col-md-12 text-center">',$headings).'</div>
              </div>';

  $calendar.= '<div class="row calendar-row no-gutters">';
  $last_cell=$diaSemana+$ultimoDiaMes;
// hacemos un bucle hasta 42, que es el máximo de valores que puede
// haber... 6 columnas de 7 dias
for($i=1;$i<=42;$i++)
{
if($i==$diaSemana)
{
  // determinamos en que dia empieza
  $day=1;
}
if($i<$diaSemana || $i>=$last_cell)
{
  // celca vacia
  $calendar .= '<div class=" text-center col-md-12 border disabled-day">&nbsp;</div>';
}else{
          if($day<10)$day="0".$day;
          $calendar.= "<div class=\"col-md-12 calendar-day $year-$month-$day text-center border\" data-aprobadas=\"0\" data-pendientes=\"0\">";
              /* add in the day number */
              $calendar.= '<div class="day-number">'.$day.'</div>';
              $calendar.= '<div class="number-a" data-toggle="tooltip" data-placement="right" title=""></div>';
              $calendar.= '<div class="number-p" data-toggle="tooltip" data-placement="right" title=""></div>';

              /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
              $calendar.= str_repeat('<p> </p>',2);

          $calendar.= '</div>';
          // $calendar .= "<td>$day</td>";
  $day++;
}
// cuando llega al final de la semana, iniciamos una columna nueva
if($i%7==0)
{
  $calendar .= "</div><div class=\"row calendar-row no-gutters\">\n";
}
}

  /* end the table */
  $calendar.= '</div>
      </div>';

  /* all done, return result */
  return $calendar;
}
