<?php

require 'vendor/autoload.php';

/* draws a calendar */
function draw_calendar($month){

$festivos = array(
  array('dia'=>'1','mes'=>'1'),
  array('dia'=>'6','mes'=>'6'),
  array('dia'=>'3','mes'=>'2'),
  array('dia'=>'19','mes'=>'3'),
  array('dia'=>'29','mes'=>'3'),
  array('dia'=>'30','mes'=>'3'),
  array('dia'=>'1','mes'=>'5'),
  array('dia'=>'9','mes'=>'6'),
  array('dia'=>'15','mes'=>'8'),
  array('dia'=>'12','mes'=>'10'),
  array('dia'=>'1','mes'=>'11'),
  array('dia'=>'3','mes'=>'12'),
  array('dia'=>'6','mes'=>'12'),
  array('dia'=>'8','mes'=>'12'),
  array('dia'=>'25','mes'=>'12')
);

$meses = array(
  1 => 'Enero',
  2 => 'Febrero',
  3 => 'Marzo',
  4 => 'Abril',
  5 => 'Mayo',
  6 => 'Junio',
  7 => 'Julio',
  8 => 'Agosto',
  9 => 'Septiembre',
  10 => 'Octubre',
  11 => 'Noviembre',
  12 => 'Diciembre'
);
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
  $calendar.= '<div class="row no-gutters border-bottom"><h4 class="text-center col-md-84">'.$meses[$month].'</h4></div>';
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
    $calendar .= '<div class="day text-center col-md-12 border disabled-day">&nbsp;</div>';
  }else{
    $class = ($i%7==0)?'no-day':'';
    foreach ($festivos as $festivo) {
      if($festivo['mes'] == $month && $festivo['dia'] == $day && !$class){
        $class = 'festivo';
      }
    }
    $calendar.= "<div class=\"day col-md-12 $year-$month-$day $class text-center border \" data-aprobadas=\"0\" data-pendientes=\"0\">";
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
